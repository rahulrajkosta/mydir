<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Cms_images_table_Resource extends JsonResource
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
			'page_id' => $this->page_id,
			'image_url' => $this->image_url,
			'alt_text' => $this->alt_text,
			
        ];
    }
}
