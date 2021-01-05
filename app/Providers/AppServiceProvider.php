<?php

namespace App\Providers;

use App\Http\ViewComposers\SettingComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Render Views with SettingComposer
         */
        View::composer(
            [
                'layouts.app',
                'includes.tasks.taskList',
                'tasks.createTask',
                'tasks.editTask'
            ],
            SettingComposer::class
        );
    }
}
