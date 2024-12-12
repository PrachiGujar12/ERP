<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;
    public $table = 'sales';
    public $primaryKey = 'sale_id';
	
	
	public function customer()
    {
        return $this->belongsTo(Customers::class, 'customer_id', 'customer_id'); 
    }
}
