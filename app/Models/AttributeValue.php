<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    use HasFactory;

    public $table = 'attribute_values';
    public $primaryKey = 'attribute_value_id';

    protected $fillable = ['title'];

    public function productAttribute()
    {
        return $this->belongsTo(ProductAttribute::class);
    }

      public function product()
    {
        return $this->belongsTo(Products::class);
    }
}
