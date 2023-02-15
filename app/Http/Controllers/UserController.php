<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\address;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\emailCode;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
       // return view('users.index', ['users' => $model->paginate(15)]);
    }

    public function user()
    {
        $user = user::where('role','2')->get();
        return view('users.index', ['user' => $user]);
    }

    public function resendCode()
    {
        $user = auth::user()->id;
        $smscode = mt_rand(100000,999999);

        Mail::to(auth::user()->email)->send(new emailCode($smscode));

        user::where('id',$user)->update([
            "smscode" => $smscode
        ]);
        return redirect()->back();
    }

    public function smsVerify(Request $request)
    {
        $user = auth::user()->id;  

        $code = user::findOrFail($user);
           
        if($code->smscode == $request->code){
            user::where('id',$user)->update([
                'smsverification' => '1'
            ]);

            return redirect()->route('dashboard');
        }else{
            return redirect()->back()->with('error','Incorrect Code');
        }

        
    }

    public function driver()
    {
        $driver = user::where('role','3')->get();
        return view('users.driver', ['user' => $driver]);
    }

    public function addLicense($id,Request $request)
    {

        user::where('id',$id)->update([
            'license' => $request->license
        ]);
        return redirect()->back()->with('license', 'License Updated');
    }


    public function userShow($id)
    {
        $user = user::findOrFail($id);
        return view('users.show', ['user' => $user]);
    }

    public function driverShow($id)
    {
        $user = user::findOrFail($id);
        return view('users.driverShow', ['user' => $user]);
    }

    public function addAddress(Request $request)
    {   
        $user = auth::user()->id;
        address::insert([
            'user' => $user,
            'address' => $request->address,
            'barangay' => $request->barangay,
            'city' => $request->city
        ]);

        return redirect()->back()->with('address', 'Address Added');
    }
}


