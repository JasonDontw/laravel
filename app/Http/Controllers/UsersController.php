<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [                 //該方法接收兩個參數，第一個為中間件的名稱，第二個為要進行過濾的動作
            'except' => ['show', 'create', 'store', 'index'] //except 方法來設定 指定動作 不使用 Auth 中間件進行過濾，意為除了此處指定的動作以外，所有其他動作都必須登錄用戶才能訪問
        ]);

        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }

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

    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }


    public function update(User $user, Request $request) //因edit有回傳$user->id所以User $user用回傳ID去抓用戶
    {                                                    //而Request $request是取修改後的所有資料
        $this->validate($request, [
            'name' => 'required|max:50',
            'password' => 'nullable|confirmed|min:6' //因為不一定要改密碼所以設為可以空
        ]);

        $this->authorize('update', $user); //將$user傳給policy的updata

        $data=[];
        $data['name']=$request->name;
        if($request->password){   //因為密碼可能為空，所以判定有東西的時候才會寫入
            $data['password']=$request->password;
        }
        $user->update($data);
        session()->flash('success','修改成功'); 
        return redirect()->route('users.show', $user->id);
    }

    public function index()
    {
        $users = User::paginate(10); //分頁10個資料一頁
        return view('users.index', compact('users'));
    }

    public function destroy(User $user)
    {
        $this->authorize('destroy', $user);
        $user->delete();
        session()->flash('success', '成功删除用户！');
        return back();
    }
}
