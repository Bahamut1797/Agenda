<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class DelUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'DelUsers:delusers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete un-verified users every 30 minutes';

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
        //
        DB::table('users')
            ->where('verified', 0)
            ->delete();

    	//$this->info('User(s) deleted successfully!');
    }
}
