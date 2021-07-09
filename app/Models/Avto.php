<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avto extends Model
{
    protected $fillable = ['id_citisen','brand_avto','regis_num','color','photo','addit_inf'];
    use HasFactory;
}
