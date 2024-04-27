<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;

class TcMaster extends Model
{
    use HasFactory;

    public function cast_details()
    {
        return $this->belongsTo(Customer::class, 'company', 'id');
    }
}
