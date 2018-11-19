<?php
namespace app\common\button;

use app\common\helpers\Html;
use app\common\helpers\Json;
use app\common\helpers\Url;
use app\common\widgets\RegisterModal;

/**
 * Class LinkActionButton
 * @package app\common\grid
 *
 * @author Dzhamal Tayibov
 * @todo Добавить проверку, что если нету динамикМодел, то кнопка заблочена
 * @todo common-component
 */
class LinkActionButton extends ActionButton
{
    /**
     * @var string
     */
    public $url;
    /**
     * @var bool
     */
    public $isConfirm = false;
    /**
     * @var bool
     */
    public $isAjax = true;
    /**
     * @var string
     */
    public $confirmMessage = 'Вы действительно хотите подтвердить это действие?';


    /**
     * @return string|null
     */
    public function render()
    {
        if(!$this->access) {
            return null;
        }
        if ($this->disabled) {
            Html::addCssClass($this->options, 'disabled');
        }
        $this->options['data-primary_attribute'] = $this->primaryAttribute;
        if ($this->isConfirm && is_string($this->confirmMessage)) {
            $this->options['onclick'] = RegisterModal::createMethod('confirm', $this->confirmMessage);
        }
        if ($this->name) {
            $this->options['name'] = $this->name;
        }
        $this->options['data-is_dynamic_model'] = Json::encode($this->isDynamicModel);
        if (!isset($this->url)) {
            $this->url = Url::to(\Yii::$app->request->getUrl());
        }
        if(!$this->isAjax) {
            return Html::a($this->value, Url::toRoute($this->url), $this->options);
        }
        return Html::ajaxLink($this->value, Url::toRoute($this->url), $this->options, empty($this->afterUpdateBlock) ? null : $this->afterUpdateBlock->getId());
    }
}
