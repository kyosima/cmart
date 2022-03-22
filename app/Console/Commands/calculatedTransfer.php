<?php

namespace App\Console\Commands;

use App\Models\HistoryPoint;
use Illuminate\Console\Command;
use App\Models\User;
use App\Models\PointC;
use App\Models\RememberC;

class calculatedTransfer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:calculatedTransfer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command calculatedTransfer';

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
        $todaytime = date('Y-m-d H:i:s');
        foreach(HistoryPoint::whereType(2)->whereMethod(2)->whereStatus(0)->get() as $history){
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
