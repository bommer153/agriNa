<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class products extends Model
{
    use HasFactory;

    public function productImage(){
        return $this->hasMany(productImage::class, 'product', 'id');
    }

    public function carts(){
        return $this->hasMany(cart::class, 'product', 'id');
    }

}
