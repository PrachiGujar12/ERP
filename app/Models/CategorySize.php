<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorySize extends Model
{
    use HasFactory;

    // Specify the table if not automatically pluralized
    protected $table = 'category_sizes';

    // Fillable fields
    protected $fillable = ['category_id', 'size'];

    // Relationship to the Category model

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id', 'category_id'); // Assuming 'id' is the primary key of SubLocation
    }
}
