<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $fillable=[
        'first_name',
        'middle_name',
        'last_name',
        'national_id',
        'image',
        'address',
        'gender',
        'mobile',
        'email',
        'employment_type',
        'salary'
    ];
}
