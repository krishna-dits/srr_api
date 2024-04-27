<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //use HasFactory;

    protected $table="customers";
    protected $primaryKey="id";
    protected $fillable=['id', 'cus_name','address1','address2','created_at','updated_at'];
}
