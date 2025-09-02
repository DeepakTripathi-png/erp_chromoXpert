<?php

namespace App\Http\Controllers\Admin\Testcase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestcaseController extends Controller
{
    public function index(){
        
        return view('Admin.Testcases.index'); 
    }

    public function add(){
        return view('Admin.Testcases.testcase-add'); 
    }

    public function view(){
        
        return view('Admin.Testcases.textcase-view'); 
    }

    public function report(){
        return view('Admin.Testcases.report');
    }
}
