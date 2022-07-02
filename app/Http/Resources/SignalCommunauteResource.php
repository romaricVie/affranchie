<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SignalCommunauteResource extends JsonResource
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
             "type" =>"signal_communaute",
             "attributes"=>[
                
                            "message"=>$this->message,
                            "image" => $this->image,
                            "communaute"=> $this->communaute,
                           // "user" => $this->user,
                            "created_at" =>$this->created_at,
                            "updated_at" =>$this->updated_at,
                         ]

        ];
    }
}
