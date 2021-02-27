<?php

declare(strict_types=1);

/** @var array $params */

use Yiisoft\Db\Connection\ConnectionInterface;
use Yiisoft\Db\Sqlite\Connection as SqliteConnection;

return [
    ConnectionInterface::class => [
        '__class' => SqliteConnection::class,
        '__construct()' => [
            'dsn' => $params['yiisoft/db-sqlite']['dsn'],
        ]
    ]
];
