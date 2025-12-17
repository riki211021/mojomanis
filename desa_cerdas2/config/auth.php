<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    */
    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Kita pakai 2 guard:
    | - "web" untuk admin (default Laravel)
    | - "layanan" untuk login warga (Layanan Masyarakat)
    |
    */
    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users', // default admin
        ],

        'layanan' => [
            'driver' => 'session',
            'provider' => 'wargas', // guard khusus warga
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | Di sini kita tambahkan provider "wargas" untuk model warga.
    | Jadi nanti warga dan admin punya tabel (atau model) berbeda.
    |
    */
    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class, // untuk admin
        ],

        'wargas' => [
            'driver' => 'eloquent',
            'model' => App\Models\Warga::class, // untuk layanan masyarakat
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    */
    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

        'wargas' => [
            'provider' => 'wargas',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    */
    'password_timeout' => 10800,

];
