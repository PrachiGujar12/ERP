<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubLocation extends Model
{
    use HasFactory;
    public $table = 'sub_locations';
    public $primaryKey = 'sub_location_id';

     public function stockItems()
    {
        return $this->hasMany(StockItems::class, 'sub_location');
    }

    public function Location()
    {
        return $this->belongsTo(StorageLocation::class, 'location', 'location_id'); // Assuming 'id' is the primary key of StorageLocation
    }
}

