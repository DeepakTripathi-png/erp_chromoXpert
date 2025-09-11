<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentTest extends Model
{
    use HasFactory;


    protected $table = 'appointments';

     protected $fillable = [
            'appintment_id',
            'test_id',
            'price'
    ];
}
