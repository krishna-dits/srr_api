<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory;

    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->select('id', 'name',);
    }

    public function getTask()
    {
        return $this->belongsTo(Task::class, 'task_id', 'id')->select('id', 'title');
    }
}
