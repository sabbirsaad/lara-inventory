<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;


class Customer extends Model
{
    use HasFactory;
    protected $primaryKey = 'customer_id';
    protected $fillable = ['customer_name', 'phone', 'email', 'address'];

    public function orders(){
        return $this->hasMany(Order::class, 'customer_id' );
    }
}
