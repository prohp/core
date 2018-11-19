<?php
namespace app\common\logic\orm;

use app\common\db\ActiveRecord;
use app\common\db\ActiveRecordHistoryInterface;
use app\common\db\ActiveRecordHistoryTrait;

/**
 * Class Seed
 *
 * @package app\common\logic\orm
 *
 *
 *
 * @property string $class_name
 *
 * @property-read SeedRecord[]   $records
 * @property-read ActiveRecord[] $models
 */
class Seed extends ActiveRecord
{
	/**
	 * @var ActiveRecord[]
	 */
	private $_models = [];

    /**
     * @inheritdoc
     */
	public function init()
    {
        $this->history = false;
        parent::init();
    }

	/**
	 * @return array
	 */
	public function rules()
	{
		return [
			[ ['class_name'], 'required', 'on' => 'default' ],
			[ ['class_name'], 'string', 'on' => 'default' ],
		];
	}

	/**
	 * @param array $attrs
	 * @return SeedRecord
	 */
	public function addRecord(array $attrs)
	{
		$record = new SeedRecord($attrs);
		$this->link('records', $record);

		return $record;
	}

	public function addActiveRecord(ActiveRecord $model)
	{
		$this->_models[] = $model;

		return $this->addRecord([
			'model' => get_class($model),
			'condition' => $model->getModelIdentity(true),
		]);
	}

	/**
	 * @return ActiveRecord[]
	 */
	public function getModels()
	{
		if ($this->_models) {
			return $this->_models;
		}
		return array_map(function (SeedRecord $record) {
			return $record->modelRecord;
		}, $this->records);
	}

	/**
	 * @return \app\common\db\ActiveQuery|\yii\db\ActiveQueryInterface
	 */
	public function getRecords()
	{
		return $this->hasMany(SeedRecord::className(), ['seed_id' => 'id'])->setAccess(false);
	}
}
