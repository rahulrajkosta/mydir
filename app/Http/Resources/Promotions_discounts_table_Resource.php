<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Promotions_discounts_table_Resource extends JsonResource
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
			'promo_code' => $this->promo_code,
			'discount' => $this->discount,
			'exp_date' => $this->exp_date,
			'applicable_products' => $this->applicable_products,
			
        ];
    }
}
