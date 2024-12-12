<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetalRates extends Model
{
    use HasFactory;

    protected $table = 'metal_rates';
    protected $primaryKey = 'metal_id';

    // Add fields to allow mass assignment
    protected $fillable = [
        'metal_type', 
        'purity', 
        'date', 
        'rate'
    ];
}
