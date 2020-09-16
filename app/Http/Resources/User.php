<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use Carbon\Carbon;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'invitation' => $this->invitation ? $this->invitation->code : NULL,
            'username' => $this->username,
            'permissions' => $this->getAllPermissions()->pluck('name'),
            'roles' => $this->roles->makeHidden(['pivot', 'permissions']),
            'crumbs' => $this->crumbs,
            'created_at' => $this->created_at ? Carbon::parse($this->created_at)->toDateTimeString() : NULL,
            'blocked' => $this->blocked,

            'initial_avatar' => $this->initial_avatar,
            'with_initials' => $this->with_initials,
            'initial_background' => $this->initial_background,
            'initials' => $this->initials,
            'avatar' => $this->image ? asset("upload/".$this->image->file) : NULL,

        ];
    }
}
