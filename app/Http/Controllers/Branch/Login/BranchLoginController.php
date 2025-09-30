<?php

namespace App\Http\Controllers\Branch\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\Branch;

class BranchLoginController extends Controller
{
    public function index()
    {
        return !empty(Session::has('Branch*%')) ? redirect('branch/dashboard') : view('Branch.Logins.login');
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

        $branch = Branch::where('email', $user_data['email'])->where('status', '!=', 'delete')->first();
        if ($branch && Hash::check($user_data['password'], $branch->password)) {
            Auth::guard('branch')->login($branch);
            if (Auth::guard('branch')->user()->status == 'inactive') {
                Auth::guard('branch')->logout();
                Session::flush();
                return redirect('/branch')->with('error', 'Contact Admin For Login.');
            } else {
                $branch_id = Auth::guard('branch')->user()->id;
                Branch::where('id', $branch_id)->update(['last_login' => date('Y-m-d H:i:s')]);
                Session::put('Branch*%', $branch_id);
                return redirect('branch/dashboard')->with('success', 'Login Successfully!');
            }
        } else {
            return redirect('/branch')->with('error', 'Invalid Login Details!');
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('branch')->logout();
        Session::flush();
        return redirect('/branch')->with('success', 'Logout Successfully!');
    }
}