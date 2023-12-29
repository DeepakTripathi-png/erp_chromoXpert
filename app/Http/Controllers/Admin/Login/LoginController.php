<?php

namespace App\Http\Controllers\Admin\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Master\Master_admin;
use App\Models\EmailSettings;
use DB;
use File;
use Response;

class LoginController extends Controller
{
    //show login form
    public function index(){ 
        return !empty(Session::has('MasterAdmin*%')) ? redirect('admin/dashboard') :  view('Admin.Logins.login'); 
    }

    // public function dashboard_view()
    // {
    //     return !empty(Session::has('MasterAdmin*%')) ? view('Admin.Dashboard.index') : redirect('/login');        
    // }

    public function admin_login(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        
        $user_data = array(
            'email' => $request->get('email'),
            'password' => $request->get('password')
        );  
        // login by Auth
        $user = Master_admin::where('email', $user_data['email'])->where('status', '!=', 'delete')->first();
        if($user && Hash::check($user_data['password'], $user->password)){
            Auth::guard('master_admins')->login($user);
            if(Auth::guard('master_admins')->user()->status == 'inactive'){
                Auth::logout();
                Session::flush();
                return redirect('/admin')->with('error', 'Contact To Admin For Login.');
            }else{
                $user_id = Auth::guard('master_admins')->user()->id;  
                $last_login = Master_admin::where('id', $user_id)->update([
                    'last_login' => date('Y-m-d H:i:s'),
                ]);
                Session::put('MasterAdmin*%', $user_id);
                return redirect('admin/dashboard')->with('success','Login Successfully!');
            }
        }else{          
            return redirect('/admin')->with('error','Invalid Login Details!');;
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        Session::flush();
        return redirect('/admin')->with('success', 'Logout Successfully!');
    }

    public function view_change_password(){
        return view('Admin.Settings.change-password');
    }

    public function change_password(Request $request){
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|string|min:6',
            'confirm_password' => 'required'
        ]);

        if(strcmp($request->new_password, $request->confirm_password) != 0){
            return redirect('admin/change-password')->with('error', 'The new password confirmation does not match.');
        }
        
        $user_data = array(
            'email' => Auth::guard('master_admins')->user()->email,
            'password' => $request->get('old_password')
        );  
        
        $user = Master_admin::where('email', $user_data['email'])->where('status', '!=', 'delete')->first();
        if($user && Hash::check($user_data['password'], $user->password)){
            Auth::guard('master_admins')->login($user);
            if(Auth::guard('master_admins')->user()->status != 'active'){
                Auth::logout();
                Session::flush();
                return redirect('admin/change-password')->with('error', 'Contact To Admin For Login.');
            }else{
                $user = Master_admin::where('email', $user_data['email'])->update(['password' => Hash::make($request->new_password)]);
                $user_id = Auth::guard('master_admins')->user()->id;  
                $last_login = Master_admin::where('id', $user_id)->update([ 'last_login' => date('Y-m-d H:i:s')]);
                Session::put('MasterAdmin*%', $user_id);
                return redirect('admin/change-password')->with('success','Password Change Successfully!');
            }
        }else{          
            return redirect('/admin/change-password')->with('error','Invalid Old Pasword !');;
        }
    }
}
