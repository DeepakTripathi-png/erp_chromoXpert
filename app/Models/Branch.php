<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Master\Master_admin;

class Branch extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'branches';
    protected $guard = 'branch';

    protected $fillable = [
        'branch_code',
        'branch_name',
        'email',
        'password',
        'mobile',
        'role_id',
        'address',
        'country_id',
        'state_id',
        'city_id',
        'pincode',
        'branch_logo_name',
        'branch_logo_path',
        'lab_incharge',
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

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function labIncharge()
    {
        return $this->belongsTo(Master_admin::class, 'lab_incharge');
    }

    public function role()
    {
        return $this->belongsTo(\App\Models\Master\Role_privilege::class, 'role_id');
    }
}