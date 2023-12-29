<?php

namespace App\Helpers\Helpers;
use App\Models\Main_inventory_stocks\Stock_update;
use App\Models\Cims_master\Warehouse;
use App\Models\Cims_master\Item;
use App\Models\Cims_master\Category;
use App\Models\Cims_master\Sub_category;
use App\Models\Cims_master\Department;
use App\Models\Cims_master\Designation;
use App\Models\Master\Master_admin;
use App\Models\Master\Role_privilege;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Helper {
    public static function itemQuantity($item_id){
        return Stock_update::where('status', 'active')->where('item_id', $item_id)->sum('quantity');
    }
    public static function itemQuantityInWarehouse($item_id, $warehouse_id){
        return Stock_update::where('status', 'active')->where('item_id', $item_id)->where('warehouse_id', $warehouse_id)->sum('quantity');
    }
    public static function getWarehouseNameByID($warehouse_id){
        return Warehouse::where('status', 'active')->where('id', $warehouse_id)->first()->warehouse_name;
    }
    public static function getItemByID($item_id){
        return Item::where('status', 'active')->where('id', $item_id)->with('unit')->first();
    }
    public static function getCreatedByName($Master_admin){
        return Master_admin::where('status', 'active')->where('id', $Master_admin)->first()->user_name;
    }
    public static function getCreatedAtDateTime($date){
        return Carbon::createFromTimestamp(strtotime($date))->setTimezone('Asia/Kolkata')->format('d-m-Y h:i A');
    }
    public static function getCreatedAtDate($date){
        return Carbon::createFromTimestamp(strtotime($date))->setTimezone('Asia/Kolkata')->format('d-m-Y');
    }
    public static function getTimeFormat($time){
        return Carbon::createFromTimestamp(strtotime($time))->format('h:i A');
    }
    public static function getCategoryByID($category_id){
        return Category::where('status', 'active')->where('id', $category_id)->first()->category;
    }
    public static function getSubCategoryByID($sub_category_id){
        return Sub_category::where('status', 'active')->where('id', $sub_category_id)->first()->sub_category;
    }
    public static function getDepartmentById($department_id){
        return department::where('status', 'active')->where('id', $department_id)->first()->department;
    }
    public static function getDesignationById($designation_id){
        return designation::where('status', 'active')->where('id', $designation_id)->first()->designation;
    }
    public static function getRoleName(){
        return Role_privilege::where('status', 'active')->where('id', Auth::guard('master_admins')->user()->role_id)->first()->role_name;
    }
}