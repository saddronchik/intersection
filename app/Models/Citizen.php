<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citizen extends Model
{
    protected $fillable = ['full_name','passport_data','date_birth','photo','place_residence','phone_number','social_account','addit_inf'];
    use HasFactory;
}
