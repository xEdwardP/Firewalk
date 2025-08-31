<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'description',
        'product_image',
        'purchase_price',
        'selling_price',
        'min_stock',
        'max_stock',
        'presentation',
        'status',
        'category_id',
    ];

    protected $table = 'products';

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
