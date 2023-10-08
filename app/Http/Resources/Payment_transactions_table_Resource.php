<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Payment_transactions_table_Resource extends JsonResource
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
			'user_id' => $this->user_id,
			'tr_date' => $this->tr_date,
			'pay_amount' => $this->pay_amount,
			'pay_status' => $this->pay_status,
			'gateway_details' => $this->gateway_details,
			
        ];
    }
}
