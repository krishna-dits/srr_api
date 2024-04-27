<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'description', 'start_date', 'end_date', 'user_ids', 'assign_user_id', 'priority', 'project_id', 'category_id', 'status', 'document', 'created_at', 'updated_at', 'deleted_at'];
}
