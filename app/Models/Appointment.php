<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

      protected $table = 'appointments';

     protected $fillable = [
             'appointment_code',
             'lab_id',
             'referee_doctor_id',
             'appointment_date',
             'appointment_time',
             'pet_id',
             'petowner_id',   
             'notes',
             'subtotal',
             'discount',
             'total',
             'created_ip_address',
             'modified_ip_address',
             'created_by',
             'modified_by',
             'status', 
    ];


    public function pet()
    {
        return $this->belongsTo(Pet::class, 'pet_id');
    }

    public function petOwner()
    {
        return $this->belongsTo(PetParent::class, 'petowner_id');
    }

    public function tests()
    {
        return $this->belongsToMany(Test::class, 'appointment_test', 'appointment_id', 'test_id');
    }



}
