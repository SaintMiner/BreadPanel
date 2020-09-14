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
            'created_at' => $this->created_at ? Carbon::parse($this->created_at)->toDateTimeString() : NULL,
            'blocked' => $this->blocked,
        ];
    }
}
