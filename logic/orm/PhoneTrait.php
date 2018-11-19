<?php
namespace app\common\logic\orm;

use app\common\db\ActiveRecord;

/**
 * Trait PhoneTrait
 * @mixin ActiveRecord
 * @package app\common\db
 */
trait PhoneTrait
{
    public function getPhones()
    {
        return $this->hasMany(Phone::class, ['entity_id' => 'id'])
            ->andOnCondition(['entity' => static::getTableSchema()->name]);
    }
}
