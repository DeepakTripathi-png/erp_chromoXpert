<?php

namespace App\Http\Controllers\Doctor\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\InternalDoctor;

class DoctorLoginController extends Controller
{
    public function index()
    {
        return !empty(Session::has('Doctor*%')) ? redirect('doctor/dashboard') : view('Doctor.Logins.login');
    }

    public function login(Request $request)
    {
       

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user_data = [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ];

        $doctor = InternalDoctor::where('email', $user_data['email'])->where('status', '!=', 'delete')->first();
        // dd(Hash::check($user_data['password'], $doctor->password));
        if ($doctor && Hash::check($user_data['password'], $doctor->password)) {
            Auth::guard('doctor')->login($doctor);
            if (Auth::guard('doctor')->user()->status == 'inactive') {
                Auth::guard('doctor')->logout();
                Session::flush();
                return redirect('/doctor')->with('error', 'Contact Admin For Login.');
            } else {
                $doctor_id = Auth::guard('doctor')->user()->id;
                InternalDoctor::where('id', $doctor_id)->update(['last_login' => date('Y-m-d H:i:s')]);
                Session::put('Doctor*%', $doctor_id);
                return redirect('doctor/dashboard')->with('success', 'Login Successfully!');
            }
        } else {
            return redirect('/doctor')->with('error', 'Invalid Login Details!');
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('doctor')->logout();
        Session::flush();
        return redirect('/doctor')->with('success', 'Logout Successfully!');
    }
}