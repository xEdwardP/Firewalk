<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryBranchBatch extends Model
{
    protected $fillable = ['batch_id', 'branch_id', 'branch_quantity'];
    protected $table = 'inventory_branch_batches';

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
