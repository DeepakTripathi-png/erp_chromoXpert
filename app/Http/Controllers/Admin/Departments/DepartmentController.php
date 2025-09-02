<?php

namespace App\Http\Controllers\Admin\Departments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    
    public function index(){
        return view('Admin.Departments.index'); 
    }

    public function add(){
        return view('Admin.Departments.add_department'); 
    }

}
