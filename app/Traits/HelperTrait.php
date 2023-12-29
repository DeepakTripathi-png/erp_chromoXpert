<?php

namespace App\Traits;

use App\Models\Master\Master_admin;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

trait HelperTrait {
    public static function getCreatedByName($Master_admin){
        return Master_admin::where('status', 'active')->where('id', $Master_admin)->first()->user_name;
    }
    public static function getCreatedAtDateTime($date){
        return Carbon::createFromTimestamp(strtotime($date))->setTimezone('Asia/Kolkata')->format('d-m-Y h:i A');
    }
    public static function getCreatedAtDate($date){
        return Carbon::createFromTimestamp(strtotime($date))->setTimezone('Asia/Kolkata')->format('d-m-Y');
    }
    public static function getCurrentDate(){
        return Carbon::now()->setTimezone('Asia/Kolkata')->format('Y-m-d');
    }
}