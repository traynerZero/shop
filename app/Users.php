<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    //

    protected $table = 'users';

    public $timestamps = true;

    protected $primaryKey = 'userid';

    protected $fillable = ['firstname','lastname','email','password','user_type','status','remember_token','created_at','updated_at'];

}
