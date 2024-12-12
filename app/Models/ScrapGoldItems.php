<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScrapGoldItems extends Model
{
    use HasFactory;
    public $table = 'scrap_gold_items';
    public $primaryKey = 'scrap_items_id';
}
