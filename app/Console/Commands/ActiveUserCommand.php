<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class ActiveUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bbs:active-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Active user calculate';

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
     * @param \App\Models\User $user
     *
     * @return mixed
     */
    public function handle(User $user)
    {
        $this->info('Active user calculating...');
        $user->cacheCalculateActiveUser();
        $this->info('Active user calculating completed successfully.');
    }
}
