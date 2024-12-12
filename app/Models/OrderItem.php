<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    public $table = 'order_items';
    public $primaryKey = 'repair_id';

	protected $fillable = [
		'category',
		'metal_type',
		'size',
		'shape',
		'diamond_type',
		'diamond_shape',
		'centre_diamond_weight',
		'total_diamond_weight',
		'matching_wedding_band',
		'half_et',
		'full_et',
		'cost_center_diamond',
		'mount_cost',
		'wedding_band_cost',
		'metal_type',
		'item_weight',
		'description',
		'karigar_id',
		'amount',
        'repair_order_number',
        'customer_id',
		'photo',
		'status',
        'payment_status',
        'sub_location',
        'location',
		'sale_amount',
    ];
	
    public function customer()
    {
        return $this->belongsTo(Customers::class, 'customer_id', 'customer_id'); 
    }
	
	public function categoryy()
    {
        return $this->belongsTo(Categories::class, 'category', 'category_id'); 
    }
	
    public function Karigar()
    {
        return $this->belongsTo(Karigar::class, 'karigar_id', 'karigar_id'); 
    }
}
