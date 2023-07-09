<?php

if (!function_exists('session') && class_exists('Leaf\Config')) {
    /**
     * Return session object
     *
     * @return \Leaf\Http\Session
     */
    function session()
    {
        if (!(\Leaf\Config::get('session.instance'))) {
            \Leaf\Config::set('session.instance', new \Leaf\Http\Session());
        }

        return \Leaf\Config::get('session.instance');
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
        if (!(\Leaf\Config::get('flash.instance'))) {
            \Leaf\Config::set('flash.instance', new \Leaf\Flash());
        }

        return \Leaf\Config::get('flash.instance');
    }
}
