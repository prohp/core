<?php
namespace app\common\logic\orm;

use app\common\db\ActiveRecord;

/**
 * Class PassportTrait
 * @mixin ActiveRecord
 * @package app\common\logic\orm
 */
trait PassportTrait
{
    public function getPassport()
    {
        return $this->hasOne(Passport::class, ['entity_id' => 'id'])
            ->andOnCondition(['entity' => static::getTableSchema()->name]);
    }
}
