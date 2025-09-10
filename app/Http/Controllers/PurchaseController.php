<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseRequest;
use App\Mail\PurchaseSupplierMail;
use App\Models\Branch;
use App\Models\InventoryBranchBatch;
use App\Models\InventoryMovement;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class PurchaseController extends Controller
{
    public function index()
    {
        return view('admin.purchases.index', [
            'title' => 'Compras',
            'items' => Purchase::latest()->get()
        ]);
    }

    public function create()
    {
        return view('admin.purchases.create', [
            'title' => 'Registrar Nueva Compra',
            'suppliers' => Supplier::pluck('company', 'id'),
            'products' => Product::pluck('name', 'id'),
            'branches' => Branch::pluck('name', 'id'),
        ]);
    }

    public function store(PurchaseRequest $request)
    {
        try {
            $purchase = Purchase::create($request->validated());

            return redirect()
                ->route('purchases.edit', $purchase->id)
                ->with('success', 'Compra registrada exitosamente, ahora puede agregar productos.');
        } catch (\Exception $e) {
            return to_route('purchases')->with('error', 'Error al registrar la compra: ' . $e->getMessage());
        }
    }

    public function edit(Purchase $purchase)
    {
        $formattedDate = \Carbon\Carbon::parse($purchase->purchased_at)->format('d/m/Y');

        return view('admin.purchases.edit', [
            'title' => 'Editar Compra',
            'label' => 'Compra N-' . $purchase->id,
            'purchase' => $purchase,
            'formattedDate' => $formattedDate,
            'suppliers' => Supplier::all(),
            'products' => Product::all(),
            'branches' => Branch::all(),
        ]);
    }

    public function show(Purchase $purchase)
    {
        $formattedDate = \Carbon\Carbon::parse($purchase->purchased_at)->format('d/m/Y');
        $purchase->load('details.product', 'supplier');
        $movement = InventoryMovement::whereHas('batch', function ($query) use ($purchase) {
            $query->whereIn('id', $purchase->details->pluck('batch_id'));
        })->where('movement_type', 'Entrada')->first();

        $branch = null;
        if ($movement) {
            $branch = Branch::findOrFail($movement->branch_id);
        }

        return view('admin.purchases.show', [
            'title' => 'Detalle de Compra Nº ' . $purchase->id,
            'formattedDate' => $formattedDate,
            'purchase' => $purchase,
            'branch' => $branch,
        ]);
    }

    public function sendEmail(Purchase $purchase)
    {
        try {
            $purchase->load('details.product', 'supplier');

            $purchase->payment_status = 'Enviada al proveedor';
            $purchase->save();

            $supplierEmail = $purchase->supplier->email;
            Mail::to($supplierEmail)->send(new PurchaseSupplierMail($purchase));

            return redirect()
                ->route('purchases.edit', $purchase->id)
                ->with('success', 'La orden de compra al proveedor fue enviada exitosamente.');
        } catch (\Throwable $e) {
            return redirect()
                ->route('purchases.edit', $purchase->id)
                ->with('error', 'Error al enviar la orden de compra al proveedor. Error: ' . $e->getMessage());
        }
    }

    public function completePurchase(Purchase $purchase, Request $request)
    {
        $purchase->load('details.product', 'supplier');

        if ($purchase->details->isEmpty()) {
            return redirect()->back()
                ->with('error', 'Error: No se puede finalizar la compra sin productos.');
        }

        $request->validate([
            'branch_id' => 'required|integer',
        ]);

        DB::beginTransaction();

        try {
            foreach ($purchase->details as $detail) {
                $batch = $detail->batch;
                $product = $detail->product;

                $batch->remaining_quantity = $batch->remaining_quantity + $detail->quantity;
                $batch->save();

                $inventoryBatch = InventoryBranchBatch::firstOrCreate([
                    'batch_id' => $batch->id,
                    'branch_id' => $request->branch_id,
                    'branch_quantity' => 0,
                ]);

                $inventoryBatch->branch_quantity = $inventoryBatch->branch_quantity + $detail->quantity;
                $inventoryBatch->save();

                $inventoryMovement = InventoryMovement::create([
                    'product_id' => $product->id,
                    'batch_id' => $batch->id,
                    'branch_id' => $request->branch_id,
                    'movement_type' => 'Entrada',
                    'moved_quantity' => $detail->quantity,
                    'moved_at' => now(),
                    'observations' => 'N/A',
                ]);
            }

            // Estado de la compra
            $purchase->payment_status = 'finalizada';
            $purchase->save();

            DB::commit();

            return redirect()->route('purchases')->with('success', 'Compra finalizada exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            dd('Error al finalizar la compra: ' . $e->getMessage());
        }
    }
}
