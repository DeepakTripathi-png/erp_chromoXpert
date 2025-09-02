<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petparent extends Model
{
    use HasFactory;

    protected $table = 'petparents';

     protected $fillable = [
             'code',
             'name',
             'gender',
             'email',
             'mobile',
             'address',
             'created_ip_address',
             'modified_ip_address',
             'created_by',
             'modified_by',
             'status', 
    ];

}
