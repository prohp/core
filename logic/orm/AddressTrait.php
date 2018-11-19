<?php
namespace app\common\logic\orm;

use app\common\db\ActiveRecord;

/**
 * Trait AddressTrait
 *
 * @mixin ActiveRecord
 *
 * 
 *
 * 
 */
trait AddressTrait
{
    /**
     * @return \yii\db\ActiveQueryInterface
     */
    public function getAddresses()
    {
        return $this->hasMany(Address::class, ['entity_id' => 'id'])
            ->andWhere([
                'entity' => static::getTableSchema()->name,
            ]);
    }
}
