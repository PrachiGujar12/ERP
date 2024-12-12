<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    public $table = 'purchase';
    public $primaryKey = 'purchase_id';

    public function items()
    {
        return $this->hasMany(StockItems::class);
    }
	
	  public function suppliers()
    {
        return $this->belongsTo(Supplier::class, 'supplier', 'supplier_id'); 
    }

}
