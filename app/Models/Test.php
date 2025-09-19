<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $table = 'tests';

    protected $fillable = [
        'test_code',
        'name',
        'short_name',
        'department_id',
        'sample_type',
        'base_price',
        'precautions',
        'created_ip_address',
        'modified_ip_address',
        'created_by',
        'modified_by',
        'status'
    ];

    public function parameters()
    {
        return $this->hasMany(TestParameters::class, 'test_id')->where('status', 'active');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}