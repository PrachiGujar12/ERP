<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders'; // Explicitly define the table name

    protected $fillable = [
        'repair_order_number',
        'customer_id',
        'amount',
        'payment_status',
        'created_by',
        'order_status',
        'order_date',
		'paid_amount',
        'estimated_delivery_date',
		'estimate_amount',
		'invoice_id'
		
		
    ];

	// In Order model
	public function orderItems()
	{
		return $this->hasMany(OrderItem::class, 'repair_order_no', 'id');
	}

	
    public function customer()
    {
        return $this->belongsTo(Customers::class, 'customer_id', 'customer_id'); 
    }
}
