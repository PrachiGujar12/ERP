<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScrapGold extends Model
{
    use HasFactory;
    public $table = 'scrap_gold';
    public $primaryKey = 'scrap_id';

    public function customer()
    {
        return $this->belongsTo(Customers::class, 'customer_id', 'customer_id'); 
    }
}
