<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;



class AdminController extends Controller
{
    public function Index(){
        // Redirect::setIntendedUrl(url()->previous());
        return view('admin.login');
    }

    public function Dashboard(){
        return view('admin.dashboard');
    }
    public function Login(Request $request){
        // dd($request->all());

            $check = $request->all();

        if(Auth::guard('admin')->attempt(['email' => $check['email'] ,
        'password' => $check['password'] ]))
        {
            return redirect()->route('admin.dashboard')->with('status','Admin logged in successfully');
            // return redirect()->intended(RouteServiceProvider::HOME);
        }else{
            return back()->with('status','Invalid Email Or Password');

        }
    }

    public function Register(){
        Redirect::setIntendedUrl(url()->previous());
        return view('admin.register');
    }

    public function Registeration(Request $request){
        // dd($request->all());
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>Hash::make($request->password) ,
            'created_at' => Carbon::now() ,


        ]);

        event(new Registered($admin));

        Auth::login($admin);

        return redirect()->route('admin.dashboard')->with('status','Admin Register successfully');
        // return redirect()->intended(RouteServiceProvider::HOME);


    }

    public function Logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin_login')->with('status','Admin logged out successfully');

    }


}
