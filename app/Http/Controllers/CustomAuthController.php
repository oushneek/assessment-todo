<?php

namespace App\Http\Controllers;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

use Hash;
use Session;


class CustomAuthController extends Controller
{

    public function index()
    {
        return view('auth.login');
    }


    public function customLogin(LoginRequest $request)
    {

        $data = $request->only(['email', 'password']);

        if (Auth::attempt($data)) {
            return redirect()->intended('dashboard')
                ->with('success','Signed in');
        }
        else
            return redirect("login")->with('error','Login details are not valid');
    }


    public function registration()
    {
        return view('auth.registration');
    }


    public function customRegistration(RegRequest $request)
    {
        try{
            $data = $request->only(['name', 'email', 'password']);

            $check = $this->create($data);

            return redirect("dashboard")->with('success','Signed-In');
        }catch(\Exception $e){
            return redirect()->route("register-user")->with('warning','Could not Register.');
        }

    }


    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }


    public function dashboard()
    {
        if (Auth::check()) {
            return view('auth.dashboard');
        }
        else
            return redirect("login")->with('warning','You are not allowed to access');
    }


    public function signOut()
    {
        Session::flush();
        Auth::logout();

        return Redirect('login')->with('success','Signed-Out Successfully.');
    }
}
