<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class Invitation extends JsonResource
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
            'code' => $this->code,
            'created_at' => $this->created_at ? Carbon::createFromFormat('Y-m-d H:m:s', $this->created_at)->toDateTimeString() : NULL,
            'expires_at' => Carbon::createFromFormat('Y-m-d', $this->expires_at)->toDateTimeString(),
            'created_by' => $this->creator ? $this->creator->username : NULL,
            'used_by' => $this->user ? $this->user->username : NULL,
        ];
    }
}
