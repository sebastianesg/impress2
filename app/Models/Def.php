<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Def extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'id'];
    
    public function selectName(){
        return $this->name;
    }
}
