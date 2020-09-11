<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
            'invitation' => $this->invitation->code,
            'username' => $this->username,
            'permissions' => $this->getAllPermissions()->pluck('name'),
            'roles' => $this->roles->makeHidden(['pivot', 'permissions']),
        ];
    }
}
