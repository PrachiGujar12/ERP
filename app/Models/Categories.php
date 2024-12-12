<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    public $table = 'categories';
    public $primaryKey = 'category_id';

    public function stockItem()
	{
		return $this->belongsTo(StockItems::class, 'category');
	}
}
