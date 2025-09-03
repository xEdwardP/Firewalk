<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'supplier_id',
        'purchased_at',
        'total',
        'payment_status',
        'observations'
    ];

    protected $table = 'purchases';

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function purchaseDetails()
    {
        return $this->hasMany(PurchaseDetail::class);
    }
}
