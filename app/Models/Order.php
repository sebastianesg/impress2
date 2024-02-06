<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'order_details', 'estado', 'senia', 'realizer_id', 'shipper_id','payment_method','contact_method'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function realizer()
    {
        return $this->belongsTo(User::class, 'realizer_id');
    }

    public function shipper()
    {
        return $this->belongsTo(User::class, 'shipper_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('precio', 'estado','link');
    }

    public function custmoProducts()
    {
        return $this->belongsToMany(CustmoProduct::class);
    }
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}