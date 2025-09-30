<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class InternalDoctor extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'internal_doctors';
    protected $guard = 'doctor';

    protected $fillable = [
        'code',
        'doctor_name',
        'gender',
        'email',
        'password',
        'mobile',
        'role_id',
        'address',
        'doctor_image_name',
        'doctor_image_path',
        'doctor_sign_name',
        'doctor_sign_path',
        'created_ip_address',
        'modified_ip_address',
        'created_by',
        'modified_by',
        'status',
        'last_login',
        'remember_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo(\App\Models\Master\Role_privilege::class, 'role_id');
    }
}