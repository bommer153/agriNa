<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    //use HasFactory;
    public function cart(){
        return $this->hasMany(cart::class, 'transaction', 'transactionNumber');
    }

    public function users(){
        return $this->hasOne(User::class, 'id', 'user');
    }

    public function myAddress(){
        return $this->hasOne(Address::class, 'id', 'address');
    }

    public function myDriver(){
        return $this->hasOne(user::class, 'id', 'driver');
    }

    public function chats(){
        return $this->hasMany(chat::class, 'transaction', 'id');
    }
}
