<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
		$data['id']= $this->id;
		$data['first_name']= $this->first_name;
				$data['last_name']= $this->last_name;

		$data['email']= $this->email;
        $data['mobile']= $this->mobile;
		//$data['image_url']= isset($this->picture)? $this->picture->full_path : null;
        return $data;
    }
}
