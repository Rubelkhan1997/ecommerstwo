<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
  function relationcard(){
      return $this->hasOne('App\Product', 'id' , 'product_id');
  }
}
