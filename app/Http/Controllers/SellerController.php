<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SellerController extends Controller
{
    public function Index(){
        return view('seller.login');
    }

    public function Dashboard(){
        return view('seller.dashboard');
    }
    public function Login(Request $request){
        // dd($request->all());

        $check = $request->all();

        if(Auth::guard('seller')->attempt(['email' => $check['email'] ,
        'password' => $check['password'] ]))
        {
            return redirect()->route('seller.dashboard')->with('status','Seller logged in successfully');
        }else{
            return back()->with('status','Invalid Email Or Password');

        }
    }

    public function Register(){
        return view('seller.register');
    }

    public function Registeration(Request $request){
        // dd($request->all());

        Seller::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>Hash::make($request->password) ,
            'created_at' => Carbon::now() ,


        ]);

        return redirect()->route('seller_login')->with('status','Seller Register successfully');

    }

    public function Logout(){
        Auth::guard('seller')->logout();
        return redirect()->route('seller_login')->with('status','Seller logged out successfully');

    }

}
