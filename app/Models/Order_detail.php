<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    use HasFactory;
    protected $primaryKey = 'order_details_id';
    protected $fillable = ['order_id', 'product_id', 'quantity', 'price', 'sub_total'];

    public function order()
    {

        return $this->belongsTo(Order::class, 'order_id');
    }
    public function product()
    {

        return $this->belongsTo(Product::class, 'product_id');
    }
}
