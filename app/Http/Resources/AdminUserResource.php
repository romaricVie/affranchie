<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminUserResource extends JsonResource
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
                           "email" => $this->email,
                           "phone" => $this->phone,
                           "roles" => $this->roles, // Roles,
                           "sexe" => $this->sexe,
                           "day" => $this->day,
                           "month" => $this->month,
                           "year" => $this->year,
                           "start_at" => $this->start_at,
                           "created_at" =>$this->created_at,
                           "updated_at" =>$this->updated_at,
                         ]

        ];
    }
}
