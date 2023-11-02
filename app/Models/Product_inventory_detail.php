<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_inventory_detail extends Model
{
    use HasFactory;
    protected $primaryKey = 'inventory_details_id';
    protected $fillable = ['product_inventory_id', 'product_id', 'quantity', 'purchase_price', 'sub_total'];

    public function productInventory()
    {

        return $this->belongsTo(ProductInventory::class, 'product_inventory_id');
    }
    public function product()
    {

        return $this->belongsTo(Product::class, 'product_id');
    }
}
