<?php

namespace App\Http\ViewComposers;

use App\Utility\SettingSingleton;
use Illuminate\View\View;

class SettingComposer
{
    /**
     *  bind Settings with view
     *
     * @param View $view
     */
    public function compose(View $view)
    {
        /**
         * theme_name: {1: dark} / {2:light}
         * from enums.setting
         */

        // get users theme_type here from singletone
        $settings = SettingSingleton::getSettingSingleton();

        $theme = $settings['theme_name'] ?? ''; // from singletone = 1/2/null

        $view->with('theme_name', config('enums.settings.theme_name.'.$theme));
    }
}
