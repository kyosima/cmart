<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\PointC;
use App\Models\RememberC;
use App\Http\Controllers\HistoryPointController;

class calculatedSavingC extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:calculatedSavingC';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculated Saving C';

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
        $historyPointController = new HistoryPointController();
        $users = User::where('id', '!=', 1)->orderBy('id', 'asc')->get();
        foreach ($users as $user) {
            $sum_rememberCs = $user->getRememberC()->whereStatus(0)->sum('balance');
            $count_rememberCs = $user->getRememberC()->whereStatus(0)->count();
            $saving = round($sum_rememberCs / $count_rememberCs * 1 / 100);
            $historyPointController->createHistory($user, $saving, 4, 1, null, null, null);
            $user->getRememberC()->whereStatus(0)->update(['status'=>1]);
        }
    }
}
