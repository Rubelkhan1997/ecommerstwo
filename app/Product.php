<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $fillable =['categorie_id','product_name','product_price','product_quantity','product_alert_quantity','product_description','product_image'];

    function relationcategory(){
        return $this->hasOne('App\Category', 'id' , 'categorie_id');
    }
}
