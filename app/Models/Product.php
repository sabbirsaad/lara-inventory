<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = ['product_name', 'unit_id', 'image', 'status'];

    public function orderDetails()
    {
        return $this->hasMany(Order_detail::class, 'product_id');
    }
    public function inventoryDetails()
    {
        return $this->hasMany(Product_inventory_detail::class, 'product_id');
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class, 'product_id');
    }
    public function units()
    {
        return $this->belongsTo(ProductUnit::class, 'unit_id');
    }
}
