<?php

class Logger
{
    private static $instance = null;
    
    private function __construct()
    {

    }

    public static function get_instance()
    {
        if (self::$instance == null) {
            self::$instance = new Logger();
        }
        return self::$instance;
    }
}

$logger = Logger::get_instance();