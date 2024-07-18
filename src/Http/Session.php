<?php

namespace Leaf\Http;

use Leaf\Anchor;

/**
 * Leaf Session
 * ----------------
 * App session management made simple with Leaf
 *
 * @author Michael Darko
 * @since 1.5.0
 */
class Session
{
    /**
     * Start a session if one isn't already started
     */
    public static function start()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    /**
     * Get a session variable
     *
     * @param string|array $param The session variable to get
     * @param mixed $default The default value to return if the requested value cannot be found
     * @param bool $sanitize Sanitize the data before returning it?
     *
     * @return mixed
     */
    public static function get($param, $default = null, bool $sanitize = true)
    {
        static::start();

        $data = Anchor::deepGetDot($_SESSION, $param);

        if ($sanitize) {
            $data = Anchor::sanitize($data);
        }

        return $data ?? $default;
    }

    /**
     * Returns the requested value and removes it from the session
     *
     * This is identical to calling `get` first and then `unset` for the same key
     *
     * @param string $key the key to retrieve and remove the value for
     * @param mixed $defaultValue the default value to return if the requested value cannot be found
     *
     * @return mixed the requested value or the default value
     */
    public static function retrieve($key, $default = null, $sanitize = false)
    {
        static::start();

        $value = static::get($key, $default, $sanitize);
        static::unsetSessionVar($key);

        return $value;
    }

    /**
     * Get all session variables as an array
     *
     * @return array array of session variables
     */
    public static function body()
    {
        static::start();

        return $_SESSION;
    }

    /**
     * Set a new session variable
     *
     * @param mixed $key: The session variable key
     * @param string $value: The session variable value
     *
     * @return void
     */
    public static function set($key, $value = null)
    {
        static::start();
        $_SESSION = Anchor::deepSetDot($_SESSION, $key, $value);
    }

    /**
     * Remove a session variable
     */
    protected static function unsetSessionVar($key)
    {
        static::start();
        $_SESSION = Anchor::deepUnsetDot($_SESSION, $key);
    }

    /**
     * Remove a session variable
     *
     * @param string $key: The session variable key
     */
    public static function unset($key)
    {
        static::start();

        if (is_array($key)) {
            foreach ($key as $field) {
                static::unsetSessionVar($field);
            }
        } else {
            static::unsetSessionVar($key);
        }
    }

    /**
     * Alias for unset
     */
    public static function delete($key)
    {
        static::unset($key);
    }

    /**
     * Remove all session variables
     */
    public static function clear()
    {
        static::start();
        session_unset();
    }

    /**
     * End the current session
     */
    public static function destroy()
    {
        static::start();
        session_destroy();
    }

    /**
     * Reset the current session
     *
     * @param string $id id to overwrite the default
     */
    public static function reset($id = null)
    {
        static::start();

        session_reset();
        static::id($id);
    }

    /**
     * Get the current session id: will set the session id if none is found
     *
     * @param string $id id to override the default
     *
     * @return string
     */
    public static function id($id = null)
    {
        static::start();

        if (!$id) {
            return session_id();
        }

        session_id($id);
        static::set('id', $id);

        return $id;
    }

    /**
     * Regenerate the session id/Generate a new session if none exists
     *
     * @param bool $clearData Clear all session data?
     *
     * @return bool True on success, false on failure
     */
    public static function regenerate($clearData = false)
    {
        session::start();

        return session_regenerate_id($clearData);
    }

    /**
     * Encodes the current session data as a string
     *
     * @return string
     */
    public static function encode(): string
    {
        static::start();

        return session_encode();
    }

    /**
     * Decodes session data from a string
     *
     * @return bool
     */
    public static function decode($data)
    {
        static::start();

        return session_decode($data);
    }

    // -------------- flash messages ---------------
    /**
     * Set or get a flash message
     *
     * @param string|null $message The flash message
     */
    public static function flash($message = null)
    {
        if (!$message) {
            return \Leaf\Flash::display();
        }

        \Leaf\Flash::set($message);
    }

    /**
     * Has Session Item
     *
     * @return bool
     */
    public static function has($key)
    {
        return static::get($key) !== null;
    }
};
