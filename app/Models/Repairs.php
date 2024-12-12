<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repairs extends Model
{
    use HasFactory;
    public $table = 'repair_items';
    public $primaryKey = 'repair_id';

	protected $fillable = [
        'repair_order_number',
        'customer_id',
        'amount',
        'payment_status',
        'sub_location',
        'location',
    ];
	
    public function customer()
    {
        return $this->belongsTo(Customers::class, 'customer_id', 'customer_id'); 
    }
    public function Karigar()
    {
        return $this->belongsTo(Karigar::class, 'karigar_id', 'karigar_id'); 
    }
}
