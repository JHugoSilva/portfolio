<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AboutResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'email'         => $this->email,
            'phone'         => $this->phone,
            'address'       => $this->address,
            'description'   => $this->description,
            'summary'       => $this->summary,
            'tagline'       => $this->tagline,
            'home_image'    => $this->home_image ? '/upload/' . $this->home_image : null,
            'banner_image'  => $this->banner_image ? '/upload/' . $this->banner_image : null,
            'cv'            => $this->cv ? '/upload/' . $this->cv : null,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
        ];
    }
}
