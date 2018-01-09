<?php

namespace App\Http\Controllers;

use App\User;

use Validator;
use Illuminate\Http\Request;

use Auth;

use Illuminate\Contracts\Auth\Authenticatable;

use Illuminate\Database\QueryException;
use App\Exceptions\Handler;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class Bankphotosauth extends Controller
{

    public function Auth_Signin(Request $request)
    {
        $messages   =   [
            'required'  => 'The :attribute field is required.',
            'max'       => 'Maximum :attribute length is :max.',
        ];
        
        $rules      =   [
            'email'     => 'required|max:254',
            'password'  => 'required'
        ];

        $validator  = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails())
        {
        // return redirect('signin')->withErrors($validator, 'login')->withInput();
        return back()->withErrors($validator, 'login')->withInput();
        }

        $credential     = $request->input('email');
        $password       = $request->input('password');

        if(Auth::attempt(['email' => $credential, 'password' => $password]))
        {
            // $auth   = User::where('email', $credential)->firstOrFail();
            // Auth::login($auth);
            // DD($auth);
            return redirect()->intended('/home');
        }
        elseif(Auth::attempt(['username' => $credential, 'password' => $password]))
        {
            // $auth   = User::where('username', $credential)->firstOrFail();
            // Auth::login($auth);
            // DD($auth);
            return redirect()->intended('/home');
        }
        else
        {
            return redirect('signin')->withErrors(['notfound' => 'Invalid password or username given.'], 'login');
        }
    }

    public function Auth_Signup(Request $request)
    {
        $messages   =   [
            'required'  => 'The :attribute field is required.',
            'max'       => 'Maximum :attribute length is :max.',
        ];
        
        $rules      =   [
            'email'     => 'required|max:254|email|unique:users,email',
            'username'  => 'required|max:254|unique:users,username',
            'fullname'  => 'required|max:254',
            'gender'    => 'required',
            'password'  => 'required'
        ];

        $validator  = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails())
        {
            return back()->withErrors($validator, 'register')->withInput();
        }

        $users  = new User();

        $users->email       = $request->email;
        $users->username    = $request->username;
        $users->fullname    = $request->fullname;
        $users->gender      = $request->gender;
        $users->password    = bcrypt($request->password);
        $users->photo       = "users/5LpZTSoakuTybx4xrqI0spvS7LK6zlV1WnADKVFE.png";

        $users->save();

        return redirect('signup')->with('status', 'Congratulations you are now registered users!');
    }

}
