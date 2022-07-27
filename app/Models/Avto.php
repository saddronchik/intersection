<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avto extends Model
{
    protected $fillable = ['id_citisen','brand_avto','regis_num','color','photo','addit_inf','who_noticed','where_notice','detection_time','user','id_user'];
    use HasFactory;
}
