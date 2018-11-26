<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Mail;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [                 //該方法接收兩個參數，第一個為中間件的名稱，第二個為要進行過濾的動作
            'except' => ['show', 'create', 'store', 'index','confirmEmail'] //except 方法來設定 指定動作 不使用 Auth 中間件進行過濾，意為除了此處指定的動作以外，所有其他動作都必須登錄用戶才能訪問
        ]);

        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }

    public function create(){
        return view('users.create');
    }

    public function show(User $user){
        $statuses = $user->statuses()    //因Modle的user已經跟statuses關聯所以可以這樣直接取值
                           ->orderBy('created_at', 'desc') //desc 是英文 descending 的簡寫，意為倒序，也就是數字大的排靠前。
                           ->paginate(30);
        return view('users.show', compact('user','statuses')); //將user用compact包起來傳給user.show使用

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

         $this->sendEmailConfirmationTo($user);
        session()->flash('success', '驗證郵件已發送到你的註冊郵箱上，請注意查收。');

        return redirect('/');
    }

    protected function sendEmailConfirmationTo($user)
    {
        $view = 'emails.confirm';
        $data = compact('user');
        $from = 'aufree@yousails.com';
        $name = 'Aufree';
        $to = $user->email;
        $subject = "感謝註冊 Sample 應用！請確認你的郵箱。";

        Mail::send($view, $data, function ($message) use ($from, $name, $to, $subject) {
            $message->from($from, $name)->to($to)->subject($subject);
        });
    }

    public function edit(User $user) 
    {

        if(Auth::User()->id === $user->id){

        return view('users.edit', compact('user'));

        }else{
        
        return redirect()->route('users.show', Auth::User()->id);
        }

       // $this->authorize('update', $user);
        
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
        $users = User::paginate(10); //設定users是10個為資料一頁的分頁
        return view('users.index', compact('users'));
    }

    public function destroy(User $user)
    {        
        if(Auth::User()->id !== $user->id && Auth::User()->is_admin){  //$this->authorize('destroy', $user);
            $user->delete();
            session()->flash('success', '成功删除用户！');
            return back();
        }
    }

    public function confirmEmail($token){
        $user = User::where('activation_token', $token)->firstOrFail(); //where 方法接收兩個參數，第一個參數為要進行查找的字段名稱，第二個參數為對應的值，
                                                                        //查詢結果返回的是一個數組，因此我們需要使用firstOrFail 方法來取出第一個用戶，
        $user->activated = true;                                        //在查詢不到指定用戶時將返回一個404 響應。在查詢到用戶信息後，我們會將該用戶的激活狀態改為 true，激活令牌設置為空。
        $user->activation_token = null;
        $user->save();

        Auth::login($user);
        session()->flash('success', '恭喜你，激活成功！');
        return redirect()->route('users.show', [$user]);

    }

    public function followings(User $user)
    {
        $users = $user->followings()->paginate(30);
        $title = '關注的人';
        return view('users.show_follow', compact('users', 'title'));
    }

    public function followers(User $user)
    {
        $users = $user->followers()->paginate(30);
        $title = '粉絲';
        return view('users.show_follow', compact('users', 'title'));
    }
}
