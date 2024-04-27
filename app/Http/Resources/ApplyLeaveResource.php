<?php

namespace App\Http\Resources;

use App\Models\LeaveType;
use Illuminate\Http\Resources\Json\JsonResource;

class ApplyLeaveResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'from_date' => $this->from_date,
            'to_date' => $this->to_date,
            'status' => $this->status,
            'total_days' => $this->total_days,
            'applied_by' => $this->applied_by,
            'leave_type_id' => $this->leave_type_id,
            'leave_type_name' => LeaveType::find($this->leave_type_id)->name ,
            'total' => $this->total
        ];
    }
}
