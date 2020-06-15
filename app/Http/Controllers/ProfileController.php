<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;
use Hash;
use Auth;


class ProfileController extends Controller
{
    //
    public function index()
	{
        // dd('index function');
        $user = Auth::user();
        return view('profile', compact('user'));
    }


    public function updatePersonal(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'mobile' => 'required|numeric|unique:organization,mobile,'.Auth::user()->id
        ]);

        $user = auth()->user();
        $user->name = $request->name;
        $user->mobile = $request->mobile;
        if($request->profile_photo){
            $user->photo = $request->profile_photo->store('profile', 'public');
        }
        $user->save();

        return back()->with('message','Personal Info updated successfully');
		return redirect('profile');

    }


    public function updatePassword(Request $request)
	{
		$this->validate($request, [
            'password'     => 'required',
            'new_password'     => 'required|min:6',
            'cnf_new_password' => 'required|same:new_password',
        ]);
        $data = $request->all();

        $user = Organization::findOrFail(auth()->user()->id);
        if(!Hash::check($data['password'], Auth::user()->password)){
            return back()->withErrors(['Old password does not match.']);
        } else {
            $user->password = Hash::make($request->new_password);
            $user->save();
            return back()->with('message','Password updated successfully');
        }
		return redirect('profile');
	}
}
