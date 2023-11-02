<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class ProductInventory extends Model
{

    use HasFactory;
    protected $primaryKey = 'product_inventory_id';
    protected $fillable = ['supplier', 'chalan_no', 'remarks', 'received_date', 'created_by'];

    public function inventoryDetails()
    {
        return $this->hasMany(Product_inventory_detail::class, 'product_inventory_id');
    }
}
