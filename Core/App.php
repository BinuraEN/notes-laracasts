<?php

namespace Core;

class App
{
    protected static $container;
    public static function setContainer($container)
    {
        static::$container = $container;
    }

    public static function container()
    {
        return static::$container;
    }

    public static function bind($key,$resolver)
    {
        static::$container->bind($key,$resolver);
    }

    public static function resolve($key)
    {
        try{
            return static::$container->resolve($key);
        }catch(\Exception $e){
            echo $e->getMessage();
            die();
        }

    }
}