<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productImage extends Model
{
    use HasFactory;

    public function products(){
        return $this->hasOne(products::class, 'id', 'product');
    }
}
