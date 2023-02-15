<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class address extends Model
{
    use HasFactory;

    public function barangayR(){
        return $this->hasOne(barangay::class, 'id', 'barangay');
    }
}
