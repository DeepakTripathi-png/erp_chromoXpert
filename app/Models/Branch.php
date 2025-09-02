<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Master\Master_admin;

class Branch extends Model
{
    use HasFactory;

    
     protected $table = 'branches';

     protected $fillable = [
               'branch_code',
               'branch_name',
               'email',
               'mobile',
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
                'status'
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
}
