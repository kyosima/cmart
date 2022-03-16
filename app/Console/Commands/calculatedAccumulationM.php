<?php

namespace App\Console\Commands;

use App\Models\HistoryPoint;
use Illuminate\Console\Command;
use App\Models\User;
use App\Models\PointC;
use App\Models\RememberC;

class calculatedAccumulationM extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:calculatedAccumulationM';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command calculatedAccumulationM';

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
        $todaytime = date('Y-m-d 23:58:00');
        foreach(HistoryPoint::whereType(5)->whereStatus(0)->get() as $history){
            if(strtotime($history->time) <= strtotime($todaytime)){
                $user = $history->user()->first();
                $user_wallet = $user->point_c()->first();
                $user_wallet->point_c += $history->amount;
                $user_wallet->save();
                $history->status = 1;
                $history->save();
            }
        }
    }
}
