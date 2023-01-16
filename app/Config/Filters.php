<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     *
     * @var array
     */
    public $aliases = [
        'csrf'     => CSRF::class,
        'toolbar'  => DebugToolbar::class,
        'honeypot' => Honeypot::class,

        // Codeigniter Shield
        'session'    => \CodeIgniter\Shield\Filters\SessionAuth::class,
        'tokens'     => \CodeIgniter\Shield\Filters\TokenAuth::class,
        'chain'      => \CodeIgniter\Shield\Filters\ChainAuth::class,
        'auth-rates' => \CodeIgniter\Shield\Filters\AuthRates::class,
        'group'      => \CodeIgniter\Shield\Filters\GroupFilter::class,
        'permission' => \CodeIgniter\Shield\Filters\PermissionFilter::class,
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     *
     * @var array
     */
    public $globals = [
        'before' => [
            // 'honeypot',
            'csrf' => ['except' => ['home/uploadImgArticle', 'home/deleteImgArticle']],
        ],
        'after' => [
            'toolbar',
            // 'honeypot',
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['csrf', 'throttle']
     *
     * @var array
     */
    public $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     *
     * @var array
     */
    public $filters = [
        'auth-rates' => [
            'before' => [
                'login*', 'register', 'auth/*'
            ]
        ],

        'session' => [
            'before' => [
                'kategori-blog*', 'dashboard', 'edit-dashboard*', 'pages*', 'edit-pages*', 'posts*', 'kategori-sarpras*', 'sarpras*', 'kategori-kegiatan*', 'kegiatan/*', 'data-siswa-psb', 'detail-peserta*', 'download*', 'users*',
            ],
        ],
    ];
}
