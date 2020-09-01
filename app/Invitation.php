<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

class Invitation extends Model
{
    

    public function user() {
        return $this->hasOne(User::class);
    }
}
