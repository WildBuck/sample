<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SessionsController extends Controller
{
    //
    public function __construct(){
        $this->middleware('guest',[
            'only'=>['create']
        ]);
    }

    public function create(){
        return view('sessions.create');
    }

    public function store(Request $request){
        $this->validate($request,[
            'email'=>'required|email|max:255',
            'password'=>'required|min:6'
        ]);

        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password],$request->has('remember'))){
            if(Auth::user()->activated){
                session()->flash('success','欢迎回来!');
                return redirect()->intended(route('users.show',[Auth::user()]));
            }else{
                Auth::logout();
                session()->flash('warning','您的账户尚未激活，请检查邮箱中的注册邮件进行激活。');
                return redirect('/');
            }
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
