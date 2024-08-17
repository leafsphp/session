<?php

if (!function_exists('session') && class_exists('Leaf\Config')) {
    /**
     * Return session object
     *
     * @return \Leaf\Http\Session
     */
    function session()
    {
        if (!(\Leaf\Config::getStatic('session'))) {
            \Leaf\Config::singleton('session', function () {
                return new \Leaf\Http\Session();
            });
        }

        return \Leaf\Config::get('session');
    }
}

if (!function_exists('flash') && class_exists('Leaf\Config')) {
    /**
     * Return flash data/object or set flash data
     *
     * @return \Leaf\Flash
     */
    function flash()
    {
        if (!(\Leaf\Config::getStatic('flash'))) {
            \Leaf\Config::singleton('flash', function () {
                return new \Leaf\Flash();
            });
        }

        return \Leaf\Config::get('flash');
    }
}
