<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TopicResource extends JsonResource
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
             "type" =>"Forum",
             "attributes"=>[
                           
                           "user" =>$this->user,
                           "title"=>$this->title,
                           "content" => $this->content,
                           "image" => $this->image,
                           "likes" => $this->aimes,
                           "comments" => CommentaireResource::collection($this->comments),
                           "created_at" =>$this->created_at,
                           "updated_at" =>$this->updated_at,
                         ]

        ];
    }
}
