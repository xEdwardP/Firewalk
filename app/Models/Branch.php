<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    /** @use HasFactory<\Database\Factories\BranchFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $table = 'branches';

    protected $fillable = [
        'name',
        'address',
        'phone',
        'is_active',
    ];
}
