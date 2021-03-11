<?php

namespace App\Models;

use App\Models\Traits\{
    ActiveUserTrait,
    HasRole,
    LastActivedAtTrait,
    OrderTrait,
    SearchTrait
};
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Auth;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * App\Models\User
 *
 * @property int $id 主键 ID
 * @property string $name 用户名
 * @property string|null $phone 手机号
 * @property string|null $email 邮箱
 * @property \Illuminate\Support\Carbon|null $email_verified_at 邮箱验证时间
 * @property string|null $password 密码
 * @property string|null $weixin_openid 微信 OpenID
 * @property string|null $weixin_unionid 微信 UnionID
 * @property string|null $introduction 个人简介
 * @property string|null $avatar 个人头像
 * @property string|null $remember_token 记住令牌
 * @property string|null $registration_id 注册 ID
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $last_actived_at 最后活跃时间
 * @property int $notification_count 通知数量
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Permission[] $permissions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Reply[] $replies
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Topic[] $topics
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereIntroduction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereLastActivedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereNotificationCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereWeixinOpenid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereWeixinUnionid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRegistrationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User withCreatedAt($direction = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User withUpdatedAt($direction = 'asc')
 * @mixin \Eloquent
 * @property-read int|null $notifications_count
 * @property-read int|null $permissions_count
 * @property-read int|null $replies_count
 * @property-read int|null $roles_count
 * @property-read int|null $topics_count
 */
class User extends Authenticatable implements MustVerifyEmail, JWTSubject
{
    use MustVerifyEmailTrait;
    use OrderTrait;
    use SearchTrait;
    use HasRole;
    use ActiveUserTrait;
    use LastActivedAtTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'phone',
        'email',
        'password',
        'weixin_openid',
        'weixin_unionid',
        'introduction',
        'avatar',
        'registration_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_actived_at' => 'datetime',
    ];

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format($this->dateFormat ?: 'Y-m-d H:i:s');
    }

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    /**
     * Send the given notification.
     *
     * @param mixed $instance
     *
     * @return void
     */
    public function inform($instance): void
    {
        if ((int) $this->id === (int) Auth::id()) {
            return;
        }

        if (method_exists($instance, 'toDatabase')) {
            $this->increment('notification_count');
        }

        $this->notify($instance);
    }

    public function markAsRead()
    {
        $this->notification_count = 0;
        $this->save();
        $this->unreadNotifications->markAsRead();
    }

    public function searchUsers(Request $request)
    {
        if ($query = $this->toSearch($request->query())) {
            $where = [];
            foreach ($query as $key => $val) {
                $where[] = [$key, '=', $val];
            }
            $users = self::where($where)->withCreatedAt('desc')->paginate(10);
        } else {
            $users = self::withCreatedAt('desc')->paginate(10);
        }

        return $users;
    }

    public function isAuthorSelf($model): bool
    {
        return (int) $this->id === (int) $model->user_id;
    }

    public function isSuperAdmin(): bool
    {
        return $this->hasRole('Administrator') ? true : false;
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }
}
