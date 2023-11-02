<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductUnit extends Model
{
    use HasFactory;
    protected $primaryKey = 'unit_id';
    protected $fillable = ['unit_name'];

    public function units()
    {
        return $this->hasMany(Product::class, 'unit_id');
    }
}
