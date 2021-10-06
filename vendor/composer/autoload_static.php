<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5494b667fca8def96a1cf08e16cde14f
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'App\\Config\\Connection' => __DIR__ . '/../..' . '/src/Config/Connection.php',
        'App\\Controllers\\Controller' => __DIR__ . '/../..' . '/src/Controllers/Controller.php',
        'App\\Controllers\\GroupController' => __DIR__ . '/../..' . '/src/Controllers/GroupController.php',
        'App\\Controllers\\InternController' => __DIR__ . '/../..' . '/src/Controllers/InternController.php',
        'App\\Controllers\\MentorController' => __DIR__ . '/../..' . '/src/Controllers/MentorController.php',
        'App\\Models\\Group' => __DIR__ . '/../..' . '/src/Models/Group.php',
        'App\\Models\\Intern' => __DIR__ . '/../..' . '/src/Models/Intern.php',
        'App\\Models\\Mentor' => __DIR__ . '/../..' . '/src/Models/Mentor.php',
        'App\\Models\\Model' => __DIR__ . '/../..' . '/src/Models/Model.php',
        'App\\Router\\Router' => __DIR__ . '/../..' . '/src/Router/Router.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit5494b667fca8def96a1cf08e16cde14f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5494b667fca8def96a1cf08e16cde14f::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit5494b667fca8def96a1cf08e16cde14f::$classMap;

        }, null, ClassLoader::class);
    }
}