<?php

if (! function_exists('getCurrentTime' )){

    /**
     * Get current time
     * @return string
     */
    function getCurrentTime(){
        return (new DateTime())->format(DATE_W3C);
    }
}
