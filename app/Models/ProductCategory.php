<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;
    public $table = 'product_category';
    public $primaryKey = 'id';

     // Allow mass assignment for these fields
     protected $fillable = ['name', 'description', 'parent_id', 'category_image', 'status'];
    public function parent()
    {
        return $this->belongsTo(ProductCategory::class, 'parent_id');
    }

    // Define the relationship to the child categories (self-referencing relationship)
    public function children()
    {
        return $this->hasMany(ProductCategory::class, 'parent_id');
    }
}
