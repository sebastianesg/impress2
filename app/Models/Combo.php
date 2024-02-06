<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Combo extends Model
{
    protected $fillable = ['name', 'description', 'price', 'descuento'];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }
}