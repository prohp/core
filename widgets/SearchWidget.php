<?php
namespace app\common\widgets;

use app\common\base\Finder;
use app\common\db\BaseFinder;
use app\common\helpers\ArrayHelper;
use app\common\helpers\ClassHelper;
use app\common\helpers\Html;
use yii\widgets\BaseListView;

/**
 * Class SearchWidget
 * @package common\widgets
 *
 * @author Dzhamal Tayibov
 * @deprecated
 */
class SearchWidget extends FormWidget
{
    /**
     * @var array
     */
    public $list;
    /**
     * @var bool
     * @todo formOptions
     */
    public $enableAjaxValidation = false;
    /**
     * @var bool
     * @todo formOptions
     */
    public $enableClientValidation = false;
    /**
     * Данные с формы
     * @var string
     */
    public $formData;
    /**
     * @var bool
     */
    public $renderResetAfterForm = true;


    /**
     * Фильтруемый виджет
     * @deprecated пока лучше не юзать
     * @return mixed
     */
    protected function renderSearchingWidget()
    {

    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        if (!isset($this->clientClassNameDefault)) {
            $this->clientClassNameDefault = ClassHelper::getShortName(__CLASS__);
        }
        if ($this->model instanceof Finder || $this->model instanceof BaseFinder) {
            $params = [];
            parse_str($this->formData, $params);
            $this->model->load($params);
        }
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function renderInsideAfterForm()
    {
        if ($this->renderResetAfterForm) {
            echo Html::button('Очистить', [
                'class' => 'btn btn-default form-trash',
                'icon' => 'trash',
                'type' => 'reset',
            ]);
        }
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        parent::run();
        echo Html::tag('hr');
        $config = $this->list;
        if (is_array($config) && !empty($config)) {
            /** @var BaseListView $class */
            $class = ArrayHelper::remove($config, 'class');
            $config['filterModel'] = $this->model;
            // todo $class instanceof BaseListView
            echo $class::widget($config);
        } else {
            echo $this->renderSearchingWidget();
        }
    }
}
