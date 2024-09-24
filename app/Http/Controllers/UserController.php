<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function register(Request $request){
       
        $userInputs = $request->validate([
            'name' => ['required', 'min:3', 'max:10', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'max:200']
        ]);
       
        $userInputs['password'] = bcrypt($userInputs['password']);
        $user = User::create($userInputs);

        auth()->login($user);
        return redirect('/');
    }

    public function login(Request $request){
        $userInputs = $request->validate([
            'loginname' => 'required',
            'loginpassword' => 'required'
        ]);

        if(auth()->attempt(['name' => $userInputs['loginname'], 
                           'password' => $userInputs['loginpassword']])){
            $request->session()->regenerate();
        }

        return redirect('/');

    }

    public function logout(){
        auth()->logout();
        return redirect('/');
    }

}
