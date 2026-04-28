<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guarantor extends Model
{
    //
    protected $fillable=[
        'first_name',
        'middle_name',
        'last_name',
        'mobile',
        'email',
        'address',
        'national_id',
        'employment_type'
    ];
}
