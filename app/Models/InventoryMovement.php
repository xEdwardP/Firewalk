<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryMovement extends Model
{
    protected $fillable = [
        'product_id',
        'batch_id',
        'branch_id',
        'movement_type',
        'moved_quantity',
        'moved_at',
        'observations'
    ];

    protected $table = 'inventory_movements';

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function batch(){
        return $this->belongsTo(Batch::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
