<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Auth;

class GenerateTokenCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bbs:generate-token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate token for user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $userId = $this->ask('Please enter the user ID:');

        if (! $user = User::find($userId)) {
            $this->error('User does not exist.');
            return;
        }

        $ttl = now()->addYear()->getTimestamp();
        $this->info(Auth::guard('api')->setTTL($ttl)->fromUser($user));
    }
}
