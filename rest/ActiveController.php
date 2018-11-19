<?php
namespace app\common\rest;

use app\common\db\ActiveRecord;

/**
 * Class ActiveController
 * @package app\common\rest
 *
 * 
 */
class ActiveController extends \yii\rest\ActiveController
{
    /**
     * @var string the scenario used for creating a model.
     * @see \yii\base\Model::scenarios()
     */
    public $createScenario = ActiveRecord::SCENARIO_CREATE;
    /**
     * @var string the scenario used for updating a model.
     * @see \yii\base\Model::scenarios()
     */
    public $updateScenario = ActiveRecord::SCENARIO_UPDATE;
}
