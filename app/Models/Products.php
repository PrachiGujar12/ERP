<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    public $table = 'products';
    public $primaryKey = 'product_id';

    protected $fillable = ['product_name', 'description', 'sku', 'price','categories','product_image','permalink','slug','seo_title','seo_description','taxes','top_view_image'];

    public function attributeValues()
    {
        return $this->hasMany(ProductAttributeValue::class);
    }

     public function productAttribute()
    {
        return $this->hasMany(ProductAttribute::class);
    }

    public function categoryNames()
    {
        // Convert comma-separated IDs into an array
        $categoryIds = explode(',', $this->categories);
    
        // Fetch category names from the ProductCategory table
        return ProductCategory::whereIn('id', $categoryIds)->pluck('name');
    }

}
