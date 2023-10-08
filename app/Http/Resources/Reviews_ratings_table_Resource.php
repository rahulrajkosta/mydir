<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Reviews_ratings_table_Resource extends JsonResource
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
			'product_id' => $this->product_id,
			'rating' => $this->rating,
			'review_text' => $this->review_text,
			'time_stamp' => $this->time_stamp,
			
        ];
    }
}
