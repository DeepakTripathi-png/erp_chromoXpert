<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestResults extends Model
{
    use HasFactory;

     protected $table = 'test_results';

    protected $fillable = [
            'test_result_code',
            'appointment_id',
            'test_id',
            'result',
            'priority', 
            'status',
            'comment',
            'created_ip_address',
            'modified_ip_address',
            'created_by',
            'modified_by',
    ];
}
