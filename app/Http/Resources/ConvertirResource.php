<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ConvertirResource extends JsonResource
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
             "type" =>"Nouveau-convertir",
             "attributes"=>[
                            
                            "user" => $this->user,
                            "ville" => $this->ville,
                            "habitation" => $this->habitation,
                            "email" => $this->email,
                            "phone" => $this->phone,
                            "motivation" => $this->motivation,
                            "image" => $this->image,
                            "created_at" =>$this->created_at,
                            "updated_at" =>$this->updated_at,
                         ]

        ];
    }
}
