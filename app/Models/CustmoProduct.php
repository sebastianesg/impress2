<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Panoscape\History\HasOperations;

class CustmoProduct extends Model
{
    public $timestamps = false;

    protected $fillable = ['description', 'price', 'pages','path'];

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
}
