<?php

namespace App\Console\Commands;

use App\Http\Controllers\QuorumController;
use App\User;
use Illuminate\Console\Command;

class CheckShortTermThrift extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stt:dailyupdate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Daily update Short Term Thrift';

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
        $quorumController = new QuorumController();
        $users = User::where('is_matrix_thrift', '<>', 0)->where('is_thrift_completed', 0)->get();

        foreach ($users as $user) {
            $quorumController->doShortTermThrift($user);
        }

        $this->info('Short Term Thrift daily update completed');
    }
}
