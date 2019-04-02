<?php

namespace App\Models;

use App\Models\Traits\{
    ActiveUserTrait,
    HasRole,
    LastActivedAtTrait,
    OrderTrait
};
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable implements MustVerifyEmail
{
    use MustVerifyEmailTrait;
    use OrderTrait;
    use HasRole;
    use ActiveUserTrait;
    use LastActivedAtTrait;
    use Notifiable {
        notify as protected inform;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'phone', 'email', 'password', 'introduction', 'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

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
    public function notify($instance)
    {
        if ((int) $this->id === (int) Auth::id()) {
            return;
        }

        if (method_exists($instance, 'toDatabase')) {
            $this->increment('notification_count');
        }

        $this->inform($instance);
    }

    public function markAsRead()
    {
        $this->notification_count = 0;
        $this->save();
        $this->unreadNotifications->markAsRead();
    }

    public function isAuthorSelf($model): bool
    {
        return (int) $this->id === (int) $model->user_id;
    }

    public function isSuperAdmin(): bool
    {
        return $this->hasRole('Administrator') ? true : false;
    }
}
