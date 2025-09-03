<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    /** @use HasFactory<\Database\Factories\SupplierFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'company',
        'address',
        'name',
        'phone',
        'email',
    ];

    protected $table = 'suppliers';

    public function batches()
    {
        return $this->hasMany(Batch::class);
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
