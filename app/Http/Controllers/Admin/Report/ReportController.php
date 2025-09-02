<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
      public function index(){
        return view('Admin.Reports.index'); 
    }

    public function getGenerateReport(){
        return view('Admin.Reports.report-generate');
    }

    public function viewReport(){
        return view('Admin.Reports.report-view');
    }
}
