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
                            "title" => $this->title,
                            "visibilite" => $this->visibilite,
                          //  "maskAsRead" => $this->maskAsRead,
                            "subject" => $this->subject,
                            "image" => $this->image,
                          //  "asRead" => $this->intercesseurs,
                            "created_at" =>$this->created_at,
                            "updated_at" =>$this->updated_at,
                         ]

        ];
    }
}
