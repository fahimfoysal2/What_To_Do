<?php

namespace Database\Seeders;

use App\Repository\SettingRepository;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    private $settingRepository;

    public function __construct(SettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            'theme_name' => 'light'
        ];

        $this->settingRepository->saveSettings($settings);
    }
}
