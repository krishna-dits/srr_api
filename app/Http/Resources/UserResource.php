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
            "id" => $this->id,
            "emp_id" => $this->emp_id,
            "name" => $this->name,
            "email" => $this->email,
            "role_as" => $this->role_as,
            "profile_image" => url('/') . "/public/profile_picture/" . $this->profile_image,
            "phone_no" => $this->phone_no,
            "designation" => $this->designation,
            "dob" => $this->dob,
            "gender" => $this->gender,
            "date_of_joining" => $this->date_of_joining,
            "guardian_name" => $this->guardian_name,
            "marital_status" => $this->marital_status,
            "is_active" => $this->is_active,
            "is_delete" => $this->is_delete,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
