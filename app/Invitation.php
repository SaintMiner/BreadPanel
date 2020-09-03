<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

class Invitation extends Model
{
    protected $fillable = [
        'code', 'created_by', 'expires_at'
    ];

    public function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function user() {
        return $this->hasOne(User::class);
    }
}
