<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1615abfcb9deb7462fa804a81956eb41
{
    public static $prefixLengthsPsr4 = array (
        'V' => 
        array (
            'Valitron\\' => 9,
        ),
        'U' => 
        array (
            'Utrust\\Utrust\\' => 14,
            'Utrust\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Valitron\\' => 
        array (
            0 => __DIR__ . '/..' . '/vlucas/valitron/src/Valitron',
        ),
        'Utrust\\Utrust\\' => 
        array (
            0 => __DIR__ . '/../..' . '/includes',
        ),
        'Utrust\\' => 
        array (
            0 => __DIR__ . '/..' . '/utrust/utrust/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit1615abfcb9deb7462fa804a81956eb41::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1615abfcb9deb7462fa804a81956eb41::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit1615abfcb9deb7462fa804a81956eb41::$classMap;

        }, null, ClassLoader::class);
    }
}
