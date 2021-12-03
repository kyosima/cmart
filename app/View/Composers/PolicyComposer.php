<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\Models\InfoCompany;
use App\Models\Settings;

class PolicyComposer
{
    /**
     * The user repository implementation.
     *
     * @var \App\Repositories\UserRepository
     */

    /**
     * Create a new profile composer.
     *
     * @param  \App\Repositories\UserRepository  $users
     * @return void
     */
    public function __construct()
    {
        // Dependencies are automatically resolved by the service container...
        
    }

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $info_company = InfoCompany::select('name', 'slug')->where('type', 'policy')->get();
        $settings = Settings::select('key', 'plain_value')->get();
        
        $setting = array();
        
        foreach($settings->toArray() as $value){ 
            $arr = [$value['key'] => $value['plain_value']];
            $setting = $setting + $arr;
        }
        $view->with(['policy' => $info_company, 'setting' => $setting]);
    }
}