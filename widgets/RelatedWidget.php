<?php
namespace app\common\widgets;

use app\common\helpers\ArrayHelper;
use app\common\helpers\Html;

/**
 * Class RelatedWidget
 * @package app\common\widgets
 *
 * @author Dzhamal Tayibov
 */
class RelatedWidget extends Widget
{
    /**
     * @var string|array BaseListView class
     */
    public $list;
    /**
     * @var string
     */
    public $modelClass;
    /**
     * @var string PK model
     */
    public $modelPk;
    /**
     * Для обратной совместимости (dynamicModel from client)
     * @var string
     */
    public $model;
    /**
     * @var string
     */
    public $relationClass;
    /**
     * @var string
     */
    public $relationName;
    /**
     * @var string
     */
    public $afterUpdateBlockId;


    /**
     * @inheritdoc
     */
    public function init()
    {
        if (!empty($this->model)) {
            $this->modelPk = $this->model;
        }
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $class = ArrayHelper::remove($this->list, 'class');
        $this->list['visibleActionButtons'] = false;
        echo $class::widget($this->list);
        echo FormWidget::widget([
            'action' => [
                '/rest/relation-resource/relation',
            ],
            'enableAjaxValidation' => false,
            'enableClientValidation' => false,
            'validateOnBlur' => false,
            'animateLoading' => false,
            'afterUpdateBlockId' => $this->afterUpdateBlockId,
            'callback' => function () {
                echo Html::hiddenInput('RelationModelPk', null, ['id' => 'relation-model-pk']);
                echo Html::hiddenInput('ModelClass', $this->modelClass, ['id' => 'model-class']);
                echo Html::hiddenInput('RelationClass', $this->relationClass, ['id' => 'relation-class']);
                echo Html::hiddenInput('RelationName', $this->relationName, ['id' => 'relation-name']);
                echo Html::hiddenInput('ModelPk', $this->modelPk, ['id' => 'model-pk']);
                echo Html::submitButton('Выбрать', [
                    'class' => 'btn btn-primary',
                    'icon' => 'save',
                    'disabled' => true,
                ]);
                echo '&nbsp';
                echo Html::button('Отмена', [
                    'class' => 'btn btn-default',
                    'data-dismiss' => 'modal'
                ]);
            }
        ]);
    }

    /**
     * @inheritdoc
     */
    public function wrapperOptions()
    {
        return array_merge(parent::wrapperOptions(), [
            'header' => 'Связать запись',
            'size' => 'modal-lg',
        ]);
    }
}
