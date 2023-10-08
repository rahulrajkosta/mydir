<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Users_table_Resource extends JsonResource
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
           // 'id' => $this->id,
		   'created_at' => $this->created_at,
			'updated_at' => $this->updated_at,
			'username' => $this->username,
			'password' => $this->password,
			'email' => $this->email,
			'shipping' => $this->shipping,
			'billing' => $this->billing,
			'other_info' => $this->other_info,
			
        ];
    }
}
