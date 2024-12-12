<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockItems extends Model
{
    use HasFactory;
    public $table = 'stock_items';
    public $primaryKey = 'item_id';

  protected $fillable = ['item_id', 'purchase_id', 'barcode', 'invoice_no', 'location', 'sub_location','category', 'metal_type', 'purity', 'item_weight', 'quantity', 'amount','sale_amount'];
	
    public function subLocation()
    {
        return $this->belongsTo(SubLocation::class, 'sub_location', 'sub_location_id'); // Assuming 'id' is the primary key of SubLocation
    }

    public function Location()
    {
        return $this->belongsTo(StorageLocation::class, 'location', 'location_id'); // Assuming 'id' is the primary key of StorageLocation
    }

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

}
