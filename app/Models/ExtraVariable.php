<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ExtraVariable extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['name', 'value', 'module'];

    public function getImage(){
        return  !empty($this->value) ? asset('images/') . $this->value : '/images/logo/logo.png';
    }
}
