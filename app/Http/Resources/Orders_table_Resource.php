<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Orders_table_Resource extends JsonResource
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
			'user_id' => $this->user_id,
			'order_date' => $this->order_date,
			't_amount' => $this->t_amount,
			'order_status' => $this->order_status,
			'shipping_method' => $this->shipping_method,
			'payment_method' => $this->payment_method,
			'payment_status' => $this->payment_status,
			
        ];
    }
}
