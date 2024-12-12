<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ncpaymentrecord extends Model
{
    use HasFactory;

        // Specify the table name if it's different from the default plural form of the model
        protected $table = 'ncpaymentrecord';

        // Specify the fillable fields for mass assignment
        protected $fillable = [
            'nc_id',
            'amount',
            'date',
            'status',
			
        ];
	
		public function nc()
		{
			return $this->belongsTo(NCSales::class, 'nc_id', 'id'); 
		}
}
