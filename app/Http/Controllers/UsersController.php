<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function create(){
        return view('users.create');
    }

    public function show(User $user){
        return view('users.show', compact('user')); //將user用compact包起來傳給user.show使用

    }

    public function store(Request $request)//將輸入的的值定義成Request並以$request取代
                                           //方法接受一个 Illuminate\Http\Request 实例参数，我们可以使用该参数来获得用户的所有输入数据。
    {
        $this->validate($request, [ //validate 方法接收两个参数，第一个参数为用户的输入数据，第二个参数为该输入数据的验证规则。
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6'
        ]);

        $user = User::create([  //將$user建立一個User的實體
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        Auth::login($user);//自動登入
        session()->flash('success', '註冊成功'); //在_message.blade.php

        return redirect()->route('users.show', [$user]); //將實體回傳到show裡
    }

}
