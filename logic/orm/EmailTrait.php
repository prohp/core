<?php
namespace app\common\logic\orm;

use app\common\db\ActiveRecord;
use app\common\logic\orm\Email;

/**
 * Trait EmailTrait
 * @mixin ActiveRecord
 * @package app\common\db
 *
 * 
 */
trait EmailTrait
{
    /**
     * @return \yii\db\ActiveQueryInterface|array
     */
    public function getEmails()
    {
        return $this->hasMany(Email::class, ['entity_id' => 'id'])
            ->andWhere([
                'entity' => static::getTableSchema()->name,
            ]);
    }
}
