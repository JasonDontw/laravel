<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class SessionsController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }
    
    public function create()
    {
        return view('sessions.create');
    }

    public function store(Request $request){
        $credentials = $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);

        
        if (Auth::attempt($credentials , $request->has('remember'))) { //Auth::attempt預設去model名稱為User的資料庫比對資料並回傳True or fail
        session()->flash('success','登入成功');                         //Auth::attempt的第二值是LARAVEL提供的記住我的功能$request->has('remember')用於記住我的功能
        return redirect()->intended(route('users.show', [Auth::user()]));
                            //redirect() 實例提供了一個intended 方法，該方法可將頁面重定向到上一次請求嘗試訪問的頁面上，並接收一個默認跳轉地址參數，當上一次請求記錄為空時，跳轉到默認地址上。
        }else{

        session()->flash('danger','登入失敗'); //在_message.blade.php
        return redirect()->back()->withInput();

        }
    }
    public function destroy(){
        Auth::logout();
        session()->flash('success', '您已成功登出！');
        return redirect('login');
    }
    
}
