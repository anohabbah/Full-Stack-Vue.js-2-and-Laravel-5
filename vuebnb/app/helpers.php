<?php
/**
 * Created by IntelliJ IDEA.
 * User: dropbird
 * Date: 20/06/2018
 * Time: 11:45
 */

use Illuminate\Support\Facades\Config;

if (!function_exists('cdn')) {
    function cdn($asset) {
        if (Config::get('app.cdn.bypass') || !Config::get('app.cdn.url')) {
            return asset($asset);
        }

        return '//' . Config::get('app.cdn.url') . "/{$asset}";
    }
}