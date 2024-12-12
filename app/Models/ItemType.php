<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemType extends Model
{
    use HasFactory;

    protected $table = 'item_types';
    protected $primaryKey = 'item_type_id';

    public function purities()
    {
        return $this->hasMany(Purity::class); // Adjust based on your database relationships
    }
}
