<?php

namespace App\Http\Resources;

use App\Models\LeaveType;
use Illuminate\Http\Resources\Json\JsonResource;

class LeaveAllocationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'leave_type_id' => $this->leave_type_id,
            'leave_type_name' => LeaveType::find($this->leave_type_id)->name ,
            'total' => $this->total
        ];
    }
}
