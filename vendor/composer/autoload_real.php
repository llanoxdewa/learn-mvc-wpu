<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit632a7b10be4cec1f758d27c6171850c8
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInit632a7b10be4cec1f758d27c6171850c8', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit632a7b10be4cec1f758d27c6171850c8', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit632a7b10be4cec1f758d27c6171850c8::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
