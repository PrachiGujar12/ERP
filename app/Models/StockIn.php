<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockIn extends Model
{
    use HasFactory;
    public $table = 'stock_in';
    public $primaryKey = 'stock_in_id';
	
	protected $fillable = ['created_by'];
}

