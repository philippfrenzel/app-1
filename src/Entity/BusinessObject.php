<?php

declare(strict_types=1);

namespace App\Entity;

use Yiisoft\ActiveRecord\ActiveRecord;

/**
 * Entity BusinessObject.
 *
 * Database fields:
 * @property int $id
 * @property string $name
 **/

 final class BusinessObject extends ActiveRecord
{
    public function tableName(): string
    {
        return '{{%BusinessObject}}';
    }
}