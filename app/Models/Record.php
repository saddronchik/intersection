<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $fillable = ['id_user','id_citisen','id_avto','id_border','id_people'];
    use HasFactory;
}
