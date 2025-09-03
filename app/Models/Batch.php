<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    protected $fillable = [
        'product_id',
        'supplier_id',
        'batch_code',
        'received_at',
        'expires_at',
        'starting_quantity',
        'remaining_quantity',
        'purchase_price',
        'sale_price',
        'is_active',
    ];

    protected $table = 'batches';

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function inventoryBranchBatches()
    {
        return $this->hasMany(InventoryBranchBatch::class);
    }

    public function inventoryMovements()
    {
        return $this->hasMany(InventoryMovement::class);
    }

    public function purchaseDetails()
    {
        return $this->hasMany(PurchaseDetail::class);
    }
}
