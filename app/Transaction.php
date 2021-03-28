<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //

    protected $table = 'transaction';

    public $timestamps = true;

    protected $primaryKey = 'transaction_id';

    protected $fillable = ['user_id','products','total_amount','status','created_at','updated_at'];

}
