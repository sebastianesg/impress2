<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // get all data from menu.json file
        $verticalMenuJson = file_get_contents(base_path('resources/cms/data/menu-data/verticalMenu.json'));
        $verticalMenuData = json_decode($verticalMenuJson);

         // Share all menuData to all the views
        \View::share('menuData',[$verticalMenuData, $verticalMenuData]);
    }
}
