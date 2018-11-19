<?php
namespace app\common\logic\orm;

use app\common\db\ActiveRecord;
use yii\db\ActiveQueryInterface;

/**
 * Class Catalog
 * 
 *
 * 
 */
class Catalog extends ActiveRecord
{
    /**
     * @return ActiveQueryInterface
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['category_id' => 'id']);
    }
}
