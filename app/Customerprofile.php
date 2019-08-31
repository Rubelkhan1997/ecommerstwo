<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customerprofile extends Model
{
    protected $fillable=['first_name','last_name','address','phone_number','zip_code'];
}
