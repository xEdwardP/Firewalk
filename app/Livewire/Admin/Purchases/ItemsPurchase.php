<?php

namespace App\Livewire\Admin\Purchases;

use App\Models\Batch;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ItemsPurchase extends Component
{
    public Purchase $purchase;
    public $productId;
    public $quantity = 1;
    public $unitPrice;
    public $purchasePrice;
    public $salePrice;
    public $dueDate;
    public $batchCode;
    public $products;
    public $totalPurchase;

    // Se ejecuta con el componente inicialmente
    public function mount(Purchase $purchase)
    {
        $this->purchase = $purchase;
        $this->products = Product::all();
        $this->getData();
    }

    public function getData()
    {
        $this->purchase->load('details.product', 'details.batch');
        $this->totalPurchase = $this->purchase->details->sum('subtotal');

        // Reiniciar campos
        // $this->reset(['productId', 'quantity', 'unitPrice', 'purchasePrice', 'salePrice', 'dueDate', 'products', 'totalPurchase', 'batchCode']);
        $this->reset(['productId', 'quantity', 'unitPrice', 'purchasePrice', 'salePrice', 'dueDate', 'batchCode']);
        $this->quantity = 1;
    }

    protected $rules = [
        'productId' => 'required',
        'quantity' => 'required',
        'purchasePrice' => 'required',
        'salePrice' => 'required',
        'batchCode' => 'required',
    ];

    public function addItems()
    {
        $this->validate();
        // dd('Id: '. $this->productId);

        DB::beginTransaction();

        try {
            $product = Product::find($this->productId);
            $batchId = null;

            // Crear lote
            $batch = Batch::create([
                'product_id' => $product->id,
                'supplier_id' => $this->purchase->supplier->id,
                'batch_code' => $this->batchCode,
                'received_at' => now()->toDateString(),
                'expires_at' => $this->dueDate,
                'starting_quantity' => 0,
                'remaining_quantity' => 0,
                'purchase_price' => $this->purchasePrice,
                'sale_price' => $this->salePrice,
                'is_active' => true,
            ]);
            $batchId = $batch->id;

            // Crear detalle de compra
            $this->purchase->details()->create([
                'product_id' => $product->id,
                'batch_id' => $batchId,
                'unit_price' => $this->purchasePrice,
                'quantity' => $this->quantity,
                // 'subtotal' => $this->unitPrice * $this->quantity,
                'subtotal' => $this->purchasePrice * $this->quantity,
            ]);

            // Actualizar el total de la compra
            $this->purchase->total = $this->purchase->details->sum('subtotal');
            $this->purchase->save();

            DB::commit();
            $this->getData();

            $this->dispatch(
                'show-alert',
                icon: "success",
                title: 'Producto agregado',
                message: 'Producto agregado correctamente.'
            );
        } catch (\Exception $e) {
            // DB::rollbackTransaction();
            DB::rollBack();
            dd('Error: ' . $e->getMessage());
        }
    }

    public function removeItem($detailId)
    {
        DB::beginTransaction();

        try {
            $detail = PurchaseDetail::find($detailId);
            $batch_id = $detail->batch_id;
            $batch = Batch::find($batch_id);
            $batch->delete();
            $detail->delete();

            // Actualizar el total de la compra
            $this->purchase->total = $this->purchase->details->sum('subtotal');
            $this->purchase->save();

            DB::commit();
            $this->getData();

            $this->dispatch(
                'show-alert',
                icon: "success",
                title: 'Producto eliminado',
                message: 'Producto eliminado correctamente.'
            );
        } catch (\Exception $e) {
            // DB::rollbackTransaction();
            DB::rollBack();
            dd('Error al eliminar el producto: ' . $e->getMessage());
        }
    }

    public function updatedproductId($value)
    {
        $product = Product::find($value);
        if ($product) {
            $this->purchasePrice = $product->purchase_price;
            $this->salePrice = $product->selling_price;
        }
        else{
            $this->reset('purchasePrice', 'salePrice');
        }
    }

    public function render()
    {
        return view('livewire.admin.purchases.items-purchase');
    }
}
