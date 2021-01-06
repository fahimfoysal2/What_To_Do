<?php

namespace App\Http\Controllers;

use App\Repository\SettingRepository;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    private $settingRepository;

    public function __construct(SettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    /**
     * testing settings save process
     */
    public function testSettingSave()
    {
        $settings = [
            'theme_name' => config('enums.settings.theme_name.1')
        ];

        $this->settingRepository->saveSettings($settings);
    }

    public function testGetSettingName($id)
    {
        $x = config('enums.settings.theme_name.'.$id);
         print ($x) ? $x:config('enums.settings.theme_name.1');
    }

    public function testUpdateUserSetting(Request $request)
    {
        dd($request->all());
    }
}
