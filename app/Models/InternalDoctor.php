<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternalDoctor extends Model
{
    use HasFactory;

    protected $table = 'internal_doctors';

    protected $fillable = [
            'code',
            'doctor_name',
            'gender',
            'email',
            'mobile',
            'address',
            'doctor_image_name',
            'doctor_image_path',
            'doctor_sign_name',
            'doctor_sign_path',
            'created_ip_address',
            'modified_ip_address',
            'created_by',
            'modified_by',
            'status'
    ];
}
