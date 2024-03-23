<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Logout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SesiController extends Controller
{
    public function index()
    {
        return view('auth/login');
    }
    public function login(Request $request)
    {
        $request->validate(
            [
                'username' => 'required',
                'password' => 'required'

            ],
            [
                'username.required' => 'Username is Required',
                'password.required' => 'Password is Required'
            ]
        );
        $infologin = [
            'username' => $request->username,
            'password' => $request->password,
        ];
        if (Auth::attempt($infologin)) {
            if (Auth::user()->role == 'admin') {
                return redirect()->route('dashboard');
            } else if (Auth::user()->role == 'user') {
                    return redirect()->route('sentra');
            }
        } else {
            return redirect('/login')->with('error', 'Username or Password not Registered')->withInput();
        }
    }
    public function logout()
    {
        $user = Auth::user();
        $user->last_login = null;
        $data['last_login'] = null;
        User::where('id', Auth::user()->id)->update($data);
        Auth::logout();
        return redirect('/');
    }
}
