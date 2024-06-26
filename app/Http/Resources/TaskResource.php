<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
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
            'id'            => $this->id,
            'title'         => $this->title,
            'description'   => $this->description,
            'start_date'    => $this->start_date,
            'end_date'      => $this->end_date,
            'user_ids'      => json_decode($this->user_ids, true),
            'user_name'     => User::get()->whereIn('id', json_decode($this->user_ids, true))->pluck('name'),
            'assign_user_id' => $this->assign_user_id,
            'priority'      => $this->priority,
            'category_id'   => $this->category_id,
            'document'      => $this->document ? url('/') . '/public/assets/task/document/' . $this->document : null,
            'status'        => $this->status
        ];
    }
}
