<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    public $fillable = ['time','duration','id_user','ip','url','actions','method','input']; 
    use HasFactory;
    public $timestamps = false;
}

