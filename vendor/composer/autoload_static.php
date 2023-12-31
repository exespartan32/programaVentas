<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit44c7349a1e05b293cb3e0732bbaf4a40
{
    public static $prefixLengthsPsr4 = array (
        'E' => 
        array (
            'Exequiel\\Sisventas\\' => 19,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Exequiel\\Sisventas\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit44c7349a1e05b293cb3e0732bbaf4a40::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit44c7349a1e05b293cb3e0732bbaf4a40::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit44c7349a1e05b293cb3e0732bbaf4a40::$classMap;

        }, null, ClassLoader::class);
    }
}
