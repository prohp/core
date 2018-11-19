<?php
namespace app\common\logic\orm;

use app\common\db\ActiveRecord;
use yii\db\ActiveQueryInterface;

/**
 * Class Category
 * @package app\common\logic\orm
 *
 * 
 */
class Category extends ActiveRecord
{
    /**
     * @return ActiveQueryInterface
     */
    public function getCatalog()
    {
        return $this->hasOne(Catalog::className(), ['id' => 'catalog_id']);
    }

    /**
     * @return ActiveQueryInterface
     */
    public function getParent()
    {
        return $this->hasOne(self::className(), ['id' => 'parent_id']);
    }
}
