<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskReview extends Model
{
    use HasFactory;

    protected $fillable = ['task_id', 'user_id', 'rating', 'rewiew', 'created_at', 'updated_at'];

    public function get_task()
    {
        return $this->belongsTo(Task::class, 'task_id', 'id')->select('id', 'title');
    }
}
