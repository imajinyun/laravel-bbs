<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class SyncLastActiveAtCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bbs:sync-last-actived-at';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync user last actived at from redis to database';

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
    public function handle(User $user)
    {
        $this->info('Sync user last activing...');
        $user->syncLastActivedAt();
        $this->info('Sync user last actived completed successfully.');
    }
}
