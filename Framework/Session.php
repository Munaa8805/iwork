<?php


namespace Framework;

class Session
{
    /**
     * Set a session value
     * 
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public static function start()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }
    public static function get($key, $default = null)
    {
        return isset($_SESSION[$key])  ? $_SESSION[$key] : $default;
    }

    public static function has($key)
    {
        return isset($_SESSION[$key]);
    }

    public static function clear($key)
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }
    public static function destroy()
    {
        session_unset();
        session_destroy();
    }
    /**
     * Flash a message to the session
     * 
     * @param string $key
     * @param string $message
     * @return void
     */

    public static function setFlashMesage($key, $message)
    {
        self::set('flash_' . $key, $message);
    }
    public static function getFlashMessage($key, $default = null)
    {
        $message = self::get('flash_' . $key, $default);
        self::clear('flash_' . $key);
        return $message;
    }
}
