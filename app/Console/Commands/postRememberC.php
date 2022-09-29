<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\PointC;
use App\Models\RememberC;
class postRememberC extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:postRememberC';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        foreach(User::orderBy('id', 'asc')->get() as $user){
            RememberC::create([
                'user_id' => $user->id,\
                'balance' => $user->point_c()->value('point_c'),
            ]);
        }        
    }
}
