<?php

declare(strict_types=1);

namespace App\Migration;

use Yiisoft\Yii\Db\Migration\MigrationBuilder;
use Yiisoft\Yii\Db\Migration\RevertibleMigrationInterface;
use Yiisoft\Db\Sqlite\Schema;

/**
 * Class M210227162309Businessobject
 */
final class M210227162309Businessobject implements RevertibleMigrationInterface
{
    public function up(MigrationBuilder $b): void
    {
        $b->createTable('BusinessObject',[
            'BusinessObjectId' => Schema::TYPE_PK
            ,'Name' => Schema::TYPE_TEXT
        ],null);
    }

    public function down(MigrationBuilder $b): void
    {
        $b->dropTable('BusinessObject');
    }
}
