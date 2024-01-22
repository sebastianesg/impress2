<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Panoscape\History\HasOperations;

class Product extends Model
{
    public $timestamps = false;

    protected $fillable = ['name', 'description', 'price', 'stock', 'link', 'paginas'];

    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('precio', 'estado','link');
    }
}
