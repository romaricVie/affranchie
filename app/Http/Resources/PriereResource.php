<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PriereResource extends JsonResource
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
             "type" =>"Priere",
             "attributes"=>[
                            
                            "user" => $this->user,
                            "phone"=>$this->phone,
                            "email" => $this->email,
                            "subject" => $this->subject,
                            "image" => $this->image,
                           // "intercesseurs" => $this->prieres,
                            "created_at" =>$this->created_at,
                            "updated_at" =>$this->updated_at,
                         ]

        ];
    }
}
