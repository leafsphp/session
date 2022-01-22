<?php

if (!function_exists('session') && class_exists('Leaf\App')) {
    /**
     * Return session data/object or set session data
     *
     * @param string|null $key — The session data to set/get
     * @param mixed $key — The data to set
     */
    function session($key = null, $value = null)
    {
        if (!$key && !$value) {
            if (!(\Leaf\Config::get("session.instance"))) {
                \Leaf\Config::set("session.instance", new \Leaf\Http\Session());
            }

            return \Leaf\Config::get("session.instance");
        }

        if (!$value && ($key && is_string($key))) {
            return \Leaf\Http\Session::get($key);
        }

        if (!$value && ($key && is_array($key))) {
            return \Leaf\Http\Session::set($key);
        }

        return \Leaf\Http\Session::set($key, $value);
    }
}

if (!function_exists('flash') && class_exists('Leaf\App')) {
    /**
     * Return flash data/object or set flash data
     *
     * @param string|null $key — The flash data to set/get
     * @param mixed $key — The data to set
     */
    function flash($key = null, $value = null)
    {
        if (!$key && !$value) {
            if (!(\Leaf\Config::get("flash.instance"))) {
                \Leaf\Config::set("flash.instance", new \Leaf\Flash());
            }

            return \Leaf\Config::get("flash.instance");
        }

        if (!$value && is_string($key)) {
            return \Leaf\Flash::display($key);
        }

        return \Leaf\Flash::set($key, $value);
    }
}
