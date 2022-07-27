<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citizen extends Model
{
    protected $fillable = ['full_name','passport_data','passport_data1','passport_data2','date_birth','photo','place_registration','place_residence','phone_number','phone_number1','phone_number2','social_account','social_account1','social_account2','social_account3','social_account4','addit_inf','who_noticed','where_notice','detection_time','user','id_user'];
    use HasFactory;
}
