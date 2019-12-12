<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitcd69ce8048273f0daee7b657f936da0e
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

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitcd69ce8048273f0daee7b657f936da0e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitcd69ce8048273f0daee7b657f936da0e::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}