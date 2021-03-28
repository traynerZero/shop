<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //

    protected $table = 'product';

    public $timestamps = true;

    protected $primaryKey = 'product_id';

    protected $fillable = ['product_name','product_description','price','stocks','status','image','created_at','updated_at'];

}
