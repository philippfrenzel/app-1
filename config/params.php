<?php

declare(strict_types=1);

use App\Command\Hello;
use App\ViewInjection\ContentViewInjection;
use App\ViewInjection\LayoutViewInjection;
use Yiisoft\Composer\Config\Merger\Modifier\ReverseBlockMerge;
use Yiisoft\Factory\Definitions\Reference;
use Yiisoft\Yii\View\CsrfViewInjection;

return [
    'app' => [
        'charset' => 'UTF-8',
        'locale' => 'en',
        'name' => 'Tropfen App',
    ],

    'yiisoft/yii-db-migration' => [
        'createNamespace' => 'App\\Migration',
        'updateNamespace' => ['App\\Migration'],
    ],

    'yiisoft/aliases' => [
        'aliases' => [
            '@root' => dirname(__DIR__),
            '@assets' => '@root/public/assets',
            '@assetsUrl' => '@baseUrl/assets',
            '@npm' => '@root/node_modules',
            '@public' => '@root/public',
            '@resources' => '@root/resources',
            '@runtime' => '@root/runtime',
            '@views' => '@root/resources/views',
            '@message' => '@root/resources/message',
        ],
    ],

    'yiisoft/db-sqlite' => [
        'dsn' => 'sqlite:'. dirname(__DIR__) .'/runtime/data/tropfendb.db',
        //'dsn' => 'sqlite:@runtime/data/tropfendb.db',
    ],

    'yiisoft/view' => [
        'basePath' => '@views',
    ],

    'yiisoft/yii-console' => [
        'commands' => [
            'hello' => Hello::class,
        ],
    ],

    'yiisoft/yii-debug' => [
        'enabled' => true,
    ],

    'yiisoft/yii-view' => [
        'viewBasePath' => '@views',
        'layout' => '@resources/layout/main',
        'injections' => [
            Reference::to(ContentViewInjection::class),
            Reference::to(CsrfViewInjection::class),
            Reference::to(LayoutViewInjection::class),
        ],
    ],

    'yiisoft/router' => [
        'enableCache' => false,
    ],

    'yiisoft/user' => [
        'cookieLogin' => [
            'addCookie' => true,
        ],
    ],

    ReverseBlockMerge::class => new ReverseBlockMerge(),
];
