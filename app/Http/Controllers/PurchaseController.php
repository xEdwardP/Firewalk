<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseRequest;
use App\Models\Branch;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;

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
        return view('admin.purchases.edit', [
            'title' => 'Editar Compra',
            'label' => 'Compra N-' . $purchase->id,
            'item' => $purchase,
            'suppliers' => Supplier::pluck('company', 'id'),
            'products' => Product::pluck('name', 'id'),
            'branches' => Branch::pluck('name', 'id'),
        ]);
    }
}
