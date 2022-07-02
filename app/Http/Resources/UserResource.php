<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
             "type" =>"User",
             "attributes"=> [
                
                           "name"=>$this->name,
                           "firstname" => $this->firstname,
                           "profile_photo_path" => $this->profile_photo_path,
                           "cover_photo_path" =>$this->cover_photo_path,
                           "sexe" => $this->sexe,
                           "day" => $this->day,
                           "month" => $this->month,
                           "year" => $this->year,
                            "city" =>$this->city,
                            "country" => $this->country,
                            "bio" => $this->bio,
                            "web" => $this->web,
                            "start_at" => $this->start_at,
                            "verset_prefere" =>$this->prefere,
                            "Page" => $this->communaute,
                            "Roles" => $this->roles,
                            "created_at" =>$this->created_at,
                            "updated_at" =>$this->updated_at,
                         ]

        ];
    }
}
