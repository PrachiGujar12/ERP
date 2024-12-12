<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;

    // Define the table and primary key if needed
    public $table = 'product_attributes';
    public $primaryKey = 'product_attribute_id';

    // Define a relationship to attribute values
    public function attributeValues()
    {
        return $this->hasMany(AttributeValue::class, 'product_attribute_id');
    }

   
}
