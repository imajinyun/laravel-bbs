<?php

namespace App\Models\Traits;

use App\Models\Reply;
use App\Models\Topic;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

trait ActiveUserTrait
{
    /** @var array 用户数据 */
    protected $users = [];

    /** @var int 话题权重 */
    protected static $topicWeight = 4;

    /** @var int 回复权重 */
    protected static $replyWeight = 1;

    /** @var int 发表的天数 */
    protected static $publishDays = 30;

    /** @var int 提取的用户数量 */
    protected static $userNumber = 6;

    /** @var string 缓存键名 */
    private static $cacheKey = 'bbs:active_user';

    /** @var int 缓存过期时间（单位：分钟） */
    private static $cacheExpiredTime = 60;

    public function getActiveUsers()
    {
        return Cache::remember(self::$cacheKey, self::$cacheExpiredTime, function () {
            return $this->calculateActiveUsers();
        });
    }

    public function cacheCalculateActiveUser()
    {
        $users = $this->calculateActiveUsers();
        self::cacheActiveUsers($users);
    }

    private function calculateActiveUsers()
    {
        $this->calculateTopicScore();
        $this->calculateReplyScore();
        $users = array_sort($this->users, static function ($user) {
            return $user['score'];
        });
        $users = array_reverse($users, true);
        $users = array_slice($users, 0, self::$userNumber, true);

        $collect = collect();
        foreach ($users as $uid => $user) {
            if ($user = static::find($uid)) {
                $collect->push($user);
            }
        }

        return $collect;
    }

    private function calculateTopicScore()
    {
        $users = Topic::query()
            ->select(DB::raw('user_id,count(*) as topic_count'))
            ->where('created_at', '>=', now()->subDays(self::$publishDays))
            ->groupBy('user_id')
            ->get();
        $users->each(function ($user) {
            $this->users[$user->user_id]['score'] = $user->topic_count * self::$topicWeight;
        });
    }

    private function calculateReplyScore()
    {
        $users = Reply::query()
            ->select(DB::raw('user_id,count(*) as reply_count'))
            ->where('created_at', '>=', now()->subDays(self::$publishDays))
            ->groupBy('user_id')
            ->get();
        $users->each(function ($user) {
            $score = $user->reply_count * self::$replyWeight;

            if (isset($this->users[$user->user_id])) {
                $this->users[$user->user_id]['score'] += $score;
            } else {
                $this->users[$user->user_id]['score'] = $score;
            }
        });
    }

    private static function cacheActiveUsers($users)
    {
        Cache::put(self::$cacheKey, $users, self::$cacheExpiredTime);
    }
}
