<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function admin_login(Request $request)
    {
        if ($request->ajax()) {
            $remember = $request->remember_me == "1" ? true : false;
            $credentials = $request->validate([
                'email' => ['required'],
                'password' => ['required'],
            ]);
            if (Auth::guard('admin')->attempt($credentials, $remember)) {
                $request->session()->regenerate();
                Session::flash('toast', ['type' => 'success', 'title' => 'Success !', 'content' => 'Logged in successfully.']);
                $response = [
                    'status' => 'success',
                    'message' => 'Logged in successfully.',
                    'redirect' => route('admin.home')
                ];
            } else {
                $response = [
                    'status' => 'failed',
                    'message' => 'Invalid email / password.'
                ];
            }
            return response()->json($response, 200, [], JSON_PRETTY_PRINT);
        } else if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.home');
        }
        return view('login-admin', []);
    }
    public function user_login(Request $request)
    {
        if ($request->ajax()) {
            $remember = $request->remember_me == "1" ? true : false;
            $credentials = $request->validate([
                'email' => ['required'],
                'password' => ['required'],
            ]);
            if (Auth::guard('user')->attempt($credentials, $remember)) {
                $request->session()->regenerate();
                Session::flash('toast', ['type' => 'success', 'title' => 'Success !', 'content' => 'Logged in successfully.']);
                $response = [
                    'status' => 'success',
                    'message' => 'Logged in successfully.',
                    'redirect' => route('user.home')
                ];
            } else {
                $response = [
                    'status' => 'failed',
                    'message' => 'Invalid email / password.'
                ];
            }
            return response()->json($response, 200, [], JSON_PRETTY_PRINT);
        } else if (Auth::guard('user')->check()) {
            return redirect()->route('user.home');
        }
        return view('login-user', []);
    }

    public function logout(Request $request){
        Auth::guard('admin')->logout();
        Auth::guard('user')->logout();
        Session::flash('toast', ['type' => 'success', 'title' => 'Success !', 'content' => 'Logged out successfully.']);
        return redirect()->route('entry');
    }
}
