<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Border extends Model
{
    public $fillable = ['id_citisen','citizenship','full_name','date_birth','passport','crossing_date','crossing_time','way_crossing','checkpoint','route','place_birth','place_regis','user','id_user']; 
    use HasFactory;
}
