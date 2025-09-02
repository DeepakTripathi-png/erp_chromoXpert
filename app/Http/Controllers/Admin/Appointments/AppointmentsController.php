<?php

namespace App\Http\Controllers\Admin\Appointments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppointmentsController extends Controller
{
    
    public function index(){
        return view('Admin.Appointments.index'); 
    }

    public function add(){
        return view('Admin.Appointments.add-aapontments'); 
    }

    public function store(){
        return redirect('admin/appointments/reciept');
    }

    public function viewReciept(){
        return view('Admin.Appointments.reciept_view');
    }
}
