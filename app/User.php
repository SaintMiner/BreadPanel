<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Auth;
USE DB;

use Spatie\Permission\Models\Permission;
use App\Invitation;
use App\Image;
class User extends Authenticatable
{
    use Notifiable, HasRoles;
    
    protected $guard_name = 'sanctum';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password', 'invitation_id', 'initials', 'initial_background'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function invitation() {
        return $this->belongsTo(Invitation::class);
    }

    public function image() {
        return $this->belongsTo(Image::class);
    }

    public function crumbTopPlace() {
        DB::statement(DB::raw('set @row:=0'));
        $top = User::selectRaw('id, @row:=@row+1 as rowNumber')->orderByDesc('crumbs')->orderBy('updated_at', 'ASC')->get();
        $userPlace = 0;
        foreach ($top as $user) {
            if ($user->id == $this->id) {
                $userPlace = $user->rowNumber;
            }
        }
        return $userPlace;
    }

}
