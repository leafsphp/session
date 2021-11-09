<?php

if (!function_exists('session')) {
    /**
     * Return session data/object or set session data
     *
     * @param string|null $key — The session data to set/get
     * @param mixed $key — The data to set
     */
    function session($key = null, $value = null)
    {
        if (!$key && !$value) {
            return new \Leaf\Http\Session();
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

if (!function_exists('flash')) {
    /**
     * Return flash data/object or set flash data
     *
     * @param string|null $key — The flash data to set/get
     * @param mixed $key — The data to set
     */
    function flash($key = null, $value = null)
    {
        if (!$key && !$value) {
            return new \Leaf\Flash();
        }

        if (!$value && is_string($key)) {
            return \Leaf\Flash::display($key);
        }

        return \Leaf\Flash::set($key, $value);
    }
}
