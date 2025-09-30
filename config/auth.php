<?php

return [
    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'master_admins' => [
            'driver' => 'session',
            'provider' => 'master_admins',
        ],
        'doctor' => [
            'driver' => 'session',
            'provider' => 'doctors',
        ],
        'branch' => [
            'driver' => 'session',
            'provider' => 'branches',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
        'master_admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Master\Master_admin::class,
        ],
        'doctors' => [
            'driver' => 'eloquent',
            'model' => App\Models\InternalDoctor::class,
        ],
        'branches' => [
            'driver' => 'eloquent',
            'model' => App\Models\Branch::class,
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
        'master_admins' => [
            'provider' => 'master_admins',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
        'doctors' => [
            'provider' => 'doctors',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
        'branches' => [
            'provider' => 'branches',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,
];