<?php

namespace Leaf;

use Leaf\Http\Session;

/**
 * Leaf Flash
 * -----
 * Simple flash messages for your leaf apps
 *
 * @author Michael Darko <mickdd22@gmail.com>
 * @since 2.5.0
 */
class Flash
{
    private static $config = [
        'key' => 'leaf.flash',
        'default' => 'message',
        'saved' => 'leaf.flashSaved',
    ];

    /**
     * Configure leaf flash
     *
     * @param array $config Configuration for leaf flash
     */
    public static function config(array $config)
    {
        static::$config = array_merge(static::$config, $config);
    }

    /**
     * Set a new flash message
     *
     * @param mixed $message The flash message to set
     * @param string $key The key to save message
     */
    public static function set($message, string $key = 'default')
    {
        if ($key === 'default') {
            $key = static::$config['default'];
        }

        Session::set(static::$config['key'], array_merge(
            Session::get(static::$config['key']) ?? [],
            [$key => $message]
        ));
    }

    /**
     * Remove a flash message
     *
     * @param string|null $key The key of message to remove
     */
    public static function unset(string $key = null)
    {
        $data = Session::get(static::$config['key'], null, false);

        if ($key === 'default') {
            $key = static::$config['default'];
        }

        if ($key) {
            unset($data[$key]);
        } else {
            $data = [];
        }

        Session::set(static::$config['key'], $data);
    }

    /**
     * Get the flash array
     *
     * @param string|null $key The key of message to get
     * @return string|array
     */
    protected static function get(string $key = null)
    {
        if (!$key) {
            return Session::get(static::$config['key']);
        }

        if ($key === 'default') {
            $key = static::$config['default'];
        }

        $item = null;
        $items = Session::get(static::$config['key'], false);

        if (isset($items[$key])) {
            $item = $items[$key];
        }

        if ($key) {
            static::unset($key);
        }

        return $item;
    }

    /**
     * Display a flash message
     *
     * @param string $key The key of message to display
     * @return string
     */
    public static function display(string $key = 'default')
    {
        return static::get($key);
    }

    /**
     * Save a flash message (won't delete after view).
     * You can save only one message at a time.
     *
     * @param string $message The flash message to save
     */
    public static function save(string $message)
    {
        Session::set(static::$config['saved'], $message);
    }

    /**
     * Clear the saved flash message
     */
    public static function clearSaved()
    {
        Session::set(static::$config['saved'], null);
    }

    /**
     * Display the saved flash message
     */
    public static function displaySaved()
    {
        return Session::get(static::$config['saved']);
    }
}
