<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPassword;

use Auth;
class User extends Authenticatable
{
    use Notifiable;


    protected $table = 'users';

    public function gravatar($size = '100')
    {
        $hash = md5(strtolower(trim($this->attributes['email'])));
        return "http://www.gravatar.com/avatar/?s=$size";
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->activation_token = str_random(30);
        });
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function statuses()
    {
        return $this->hasMany(Status::class);
    }    

    public function feed()
    {
        $user_ids = Auth::user()->followings->pluck('id')->toArray();
        array_push($user_ids, Auth::user()->id);
        return Status::whereIn('user_id', $user_ids)
                              ->with('user')
                              ->orderBy('created_at', 'desc');
    }


    //因為追隨你的人跟你追隨的人都是user所以不需要在創建一個model直接用一個use model就可以了

//     followers 表
//   id     user_id     follower_id
//   1       2             3         // 用户3关注了用户2。也就是说用户3是用户2 的粉丝。
//   2       4             2         // 用户2关注了用户4。也就是说用户2是用户4的粉丝。
//   3       3             2         // 和第一条相反。两人互相关注。 用户2也是用户3的粉丝。
//  
//  
//   belongsToMany(1,2,3,4)
//   四个参数意思：
//    1、目标model的class全称呼。
//    2、中间表名
//    3、中间表中当前model对应的关联字段
//    4、中间表中目标model对应的关联字段
//  
//     获取粉丝：（重点：这里粉丝也是用户。所以就把User 模型也当粉丝模型来用）
//    eg: belongsToMany(User::class,'followers','user_id','follower_id');
//        粉丝表,中间表,当前model在中间表中的字段,目标model在中间表中的字段。
 
    public function followers()//追隨你的人
    {
        return $this->belongsToMany(User::Class, 'followers', 'user_id', 'follower_id'); //當前的User::Class在followers中對應到user_id去取follower_id
    }                                                                                    //因為建表的時候已經定義User的id為主建所以不需要定義則followers的user_id會自行
                                                                                         //連結id
    public function followings()//你追隨的人
    {
        return $this->belongsToMany(User::Class, 'followers', 'follower_id', 'user_id');
    }

    public function follow($user_ids)
    {
        if (!is_array($user_ids)) {
            $user_ids = compact('user_ids');
        }
        $this->followings()->sync($user_ids, false);
    }

    public function unfollow($user_ids)
    {
        if (!is_array($user_ids)) {
            $user_ids = compact('user_ids');
        }
        $this->followings()->detach($user_ids);
    }

    public function isFollowing($user_id)
    {
        return $this->followings->contains($user_id);
    }
}
