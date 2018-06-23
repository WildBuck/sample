<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SessionsController extends Controller
{
    //

    public function create(){
        return view('sessions.create');
    }

    public function store(Request $request){
        $this->validate($request,[
            'email'=>'required|email|max:255',
            'password'=>'required|min:6'
        ]);

        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password],$request->has('remember'))){
            return redirect()->route('users.show',[Auth::user()]);
        }else{
            session()->flash('danger','很抱歉，您的邮箱或密码有误');
            return redirect()->back();
        }
    }

    public function destroy(){
        Auth::logout();

        return redirect()->route('login');
    }
}
