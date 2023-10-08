<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Design_templates_table_Resource extends JsonResource
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
			'design_name' => $this->design_name,
			'design_url' => $this->design_url,
			'images' => $this->images,
			'oter_settings' => $this->oter_settings,
			
        ];
    }
}
