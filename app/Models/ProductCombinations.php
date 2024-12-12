<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCombinations extends Model
{
    use HasFactory;

    public $table = 'product_combinations';
    public $primaryKey = 'id';
}
