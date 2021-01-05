<?php

namespace App\Repository;

use App\Models\Setting;

class SettingRepository
{
    /**
     *  if available then Update, otherwise Create Setting
     *
     * @param array $settings
     *
     * $settings = ["theme_name" => "light"]
     * db = "setting_name" | "default_setting"
     * -> [ setting_name = theme_name ], [default_setting = light]
     *
     */
    public function saveSettings(array $settings)
    {

        foreach ($settings as $setting_name => $value) {
            Setting::updateOrCreate(
                ['setting_name' => $setting_name],
                ['default_setting' => $value]
            );
        }

    }

}
