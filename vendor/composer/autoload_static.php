<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitdd8bfd264abda8bf64d85a1ad7b243a6
{
    public static $files = array (
        '8d22c39e6567f3f68fd617b76fa352ab' => __DIR__ . '/../..' . '/app/helpers/helpers.php',
    );

    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitdd8bfd264abda8bf64d85a1ad7b243a6::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitdd8bfd264abda8bf64d85a1ad7b243a6::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitdd8bfd264abda8bf64d85a1ad7b243a6::$classMap;

        }, null, ClassLoader::class);
    }
}