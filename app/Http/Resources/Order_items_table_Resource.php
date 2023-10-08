<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Order_items_table_Resource extends JsonResource
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
			'product_id' => $this->product_id,
			'design_id' => $this->design_id,
			'qty' => $this->qty,
			'taxes' => $this->taxes,
			'unit_price' => $this->unit_price,
			
        ];
    }
}
