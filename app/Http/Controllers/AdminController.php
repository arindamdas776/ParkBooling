<?php

namespace App\Http\Controllers;

use App;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    //

    public function __invoke(Request $request) {
        $guard = 'admin';
        if (Auth::guard($guard)->check()) {
			return redirect(route('home'));
        }

        if ($request->isMethod('post')) {
            $captcha = session()->get('captcha_text');    
            $user = Admin::where(['email' => $request->email])->first();

            if($user) {
                if($request->captcha != $captcha) {
                    return response()->json(['message' => '', 'errors' => ['validation_error' => ['validation.captcha']]], 422);
                }
                if($request->captcha == $captcha) {
                    session()->put('captcha_text', '');
                    session()->save();
                }

                $credentials = [
                    'email' => $request->email,
                    'password' => $request->password
                ];
                $remember = $request->remember === 'on' ? true : false;
                if(Auth::guard($guard)->attempt($credentials, $remember)) {
                    session(['usertype' => 'admin']);
                    return ['type' => 'success', 'text' => 'Login Successfull'];
                }
                else {
                    return response()->json(['message' => '', 'errors' => ['validation_error' => ['Invalid Username or Password']]], 422);
                }

            }
            else {
                return response()->json(['message' => '', 'errors' => ['validation_error' => ['Invalid Username or Password']]], 422);
            }       
        } else {
            return view('admin.sign-in');
        }
    }
}
