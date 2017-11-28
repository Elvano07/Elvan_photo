<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Categories;
use Validator;
use Illuminate\Validation\Rule;
use App\Photos;
use Hash;

class Profile extends Controller
{
    public function index(){
        $data['auth']       = Auth::user();
        $data['halaman']    = '';

        $data['categories'] = Categories::orderBy('name')->get();
        $data['photos']     = Photos::where('user_id', Auth::user()->id)->with('categories')->get();
    
        return View('profile', $data);
    }

    public function edit(){
        $data['auth']       = Auth::user();
        $data['halaman']    = '';

        $data['categories'] = Categories::orderBy('name')->get();
    
        
        return View('editprofile', $data);
    }

    public function editPhoto(Request $request){

        $rules      =   [
            'photo'         => 'required',
            'image'         => 'mimes:jpeg,jpg,png,gif|required|max:5000'
        ];

        $data       =   [
            'photo'         => $request->photo,
            'image'         => $request->file('photo')
        ];

        $validator  = Validator::make($data, $rules);
        
        if ($validator->fails())
        {
            return back()->withErrors($validator, 'pp');
        }

        $profile    = Auth::user();

        $profile->photo   = $request->file('photo')->store('users');
        
        $profile->save();

        return back()->with('status', 'Photo berhasil diganti!');
    }

    public function editInformation(Request $request){

        $rules      =   [
            'username'      => [
                'required',
                'max:30',
                Rule::unique('users')->ignore(Auth::user()->id)
            ],
            'email'         => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore(Auth::user()->id)
            ],
            'fullname'      => 'required|max:255',
            'description'   => 'required|max:255',
            'gender'        => 'required|max:255'
        ];

        $validator  = Validator::make($request->all(), $rules);
        
        if ($validator->fails())
        {
            return back()->withErrors($validator, 'info');
        }

        $profile    = Auth::user();

        $profile->username      = $request->username;
        $profile->email         = $request->email;
        $profile->fullname      = $request->fullname;
        $profile->description   = $request->description;
        $profile->gender        = $request->gender;

        $profile->save();

        return back()->with('status', 'Informasi profile berhasil diubah!');
    }

    public function editPass(Request $request){

        $rules      =   [
            'oldpass'   => 'required',
            'newpass'   => 'required|same:retype',
            'retype'    => 'required|same:newpass'
        ];

        $validator  = Validator::make($request->all(), $rules);

        if(!Hash::check($request->oldpass, Auth::user()->password)){
            $validator->getMessageBag()->add('oldpass', 'Your old password is incorrect');
            return back()->withErrors($validator, 'pass');
        }

        if ($validator->fails())
        {
            return back()->withErrors($validator, 'pass');
        }

        $profile    = Auth::user();
        $profile->password  = Hash::make($request->newpass);

        $profile->save();
        return back()->with('status', 'Password berhasil diubah!');
    }
}
