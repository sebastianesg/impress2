<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Panoscape\History\HasHistories;

class Rol extends Model
{
    use HasFactory;
    //use HasHistories;

    public $timestamps = false;

    const MAX_SECTIONS = 3;

    protected $fillable = ['name', 'sections'];

    public function getNUsers(){
        return User::where('rol_id', $this->id)->count();
    }

    /*public function getModelLabel(){
        return 'Rol';
    }*/
}
