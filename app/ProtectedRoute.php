<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class ProtectedRoute extends Model
{
    use HasRoles;

    protected $guard_name = 'sanctum';

}
