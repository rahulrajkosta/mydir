<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Shipping_information_table_Resource extends JsonResource
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
			'order_id' => $this->order_id,
			'receipent_name' => $this->receipent_name,
			'shipping' => $this->shipping,
			'delivery_date' => $this->delivery_date,
			'track_information' => $this->track_information,
			
        ];
    }
}
