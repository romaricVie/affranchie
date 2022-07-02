<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PublicationResource extends JsonResource
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
             "type" =>"Publication",
             "attributes"=>[
                
                            "message"=>$this->message,
                            "image" => $this->image,
                            "video" => $this->video,
                            "communaute_id"=> (string)$this->communaute_id,
                            "likes" => $this->loves,
                            "user" => $this->user,
                            "comments" => CommentaireResource::collection($this->comments),
                            "created_at" =>$this->created_at,
                            "updated_at" =>$this->updated_at,
                         ]

        ];
    }
}
