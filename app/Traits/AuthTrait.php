<?php
namespace App\Traits;

use Exception;
use Illuminate\Support\Facades\Auth;

trait AuthTrait{
    /**
     * Check if user is authenticated,
     * throws exception
     * @throws Exception
     */
    public function userAuthCheck()
    {
        if (!Auth::user()) throw new Exception("You have to login first to use this repository!");
    }
}
