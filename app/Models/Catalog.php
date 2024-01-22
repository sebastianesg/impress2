<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Panoscape\History\HasHistories;

class Catalog extends Model
{
    use HasFactory;
    //use HasHistories;

    public $timestamps = false;

    protected $fillable = ['name', 'type', 'subtype'];

    public function subcategories()
    {
        return $this->hasMany(Catalog::class, 'subtype', 'id');
    }

    /*public function getModelLabel(){
        return 'Fichas';
    }*/
}
