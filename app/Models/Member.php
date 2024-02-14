<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Member extends Model
{
    protected $fillable = ['name', 'gender', 'phone_number', 'address', 'email'];




    public function user()
    {
        return $this->hasOne('App\Models\User', 'member_id');
    }
}
