<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommunauteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
           
             "id" => (string) $this->id,
             "type" =>"Page",
             "attributes"=>[
                
                            "name"=>$this->name,
                            "image" => $this->image,
                            "status" => $this->status,
                            "description"=> $this->description,
                            "user" =>$this->user,
                            "publications" => PublicationResource::collection($this->publications),
                            "created_at" =>$this->created_at,
                            "updated_at" =>$this->updated_at,
                         ]

        ];
    }
}
