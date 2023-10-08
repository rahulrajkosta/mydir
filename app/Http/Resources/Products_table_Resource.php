<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Products_table_Resource extends JsonResource
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
			'categ_id' => $this->categ_id,
			'names' => $this->names,
			'desc' => $this->desc,
			'price' => $this->price,
			'invent_qty' => $this->invent_qty,
			'bag_color' => $this->bag_color,
			'css_style' => $this->css_style,
			
        ];
    }
}
