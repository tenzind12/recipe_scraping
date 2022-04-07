<?php
class Session {
    public static function init() {
        session_start();
    }

    public static function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    public static function get($key) {
        if(isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
        return false;
    }

    public static function checkSession() {
        self::init();
        if(!self::get('adminlogin')) self::destroy();
    }

    public static function checkLogin() {
        self::init();
        if(self::get('adminlogin')) header('Location: catList.php');
    }

    public static function destroy() {
        session_destroy();
        echo "<script>window.location='login.php';</script>"; 
    }
} 