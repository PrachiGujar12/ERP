<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NCSales extends Model
{
    use HasFactory;
    public $table = 'ncsales';
	
	protected $fillable = [
            
            'duration',
		'note',
			
        ];
   
	public function customer()
    {
        return $this->belongsTo(Customers::class, 'customer_id', 'customer_id'); 
    }
}
