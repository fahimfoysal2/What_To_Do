<?php


namespace App\Utility;


use App\Models\Setting;
use App\Repository\SettingRepository;

class SettingSingleton
{
    private static $instance;
    private static $settingRepository;
    private static $settingData;

    /**
     * SettingSingleton constructor.
     *
     */
    private function __construct()
    {
        self::$settingRepository = (new SettingRepository());
    }

    /**
     * provide the singleton data
     *
     * @return Setting
     */
    public static function getSettingSingleton()
    {
        if (!isset(self::$instance)) {
            self::$instance = new SettingSingleton();

            self::$settingData = self::$instance->getSettingsFromDatabase();
        }

        return self::$settingData;
    }


    /**
     * Get user setting data from database
     *
     * @return mixed
     */
    private function getSettingsFromDatabase()
    {
        return self::$settingRepository->getSettings();
    }


    /**
     * update the singleton settingData
     *
     * when user update their setting- this method will save new setting in singleton
     */
    public static function updateSettingSingleton()
    {
        if (self::$instance == null) {
            self::getSettingSingleton();
        } else {
            self::$settingData = self::$instance->getSettingsFromDatabase();
        }
    }
}
