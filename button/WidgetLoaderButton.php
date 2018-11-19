<?php
namespace app\common\button;

use app\common\helpers\CommonHelper;
use app\common\helpers\Html;
use app\common\helpers\Json;
use yii\base\InvalidConfigException;

/**
 * Class WidgetLoaderButton
 *
 *
 *
 * @author Michael Lazarev
 * @author Dzhamal Tayibov
 * @todo common-component
 */
class WidgetLoaderButton extends ActionButton
{
    /**
     * @var string
     */
    public $widgetClass;
    /**
     * @var string
     */
    public $loaderMethod = 'loaderButton';
    /**
     * @var array
     */
    public $widgetConfig = [];
    /**
     * Устаревший параметр, использовать $options
     * @var array
     * @deprecated
     * @internal
     */
    private $buttonOptions = [];
    /**
     * @var string
     */
    public $wrapper = true;

    /**
     * @inheritdoc
     */
    public function init()
    {
        if (!empty($this->buttonOptions)) { //todo убрать это нахер попозже
            $this->options = $this->buttonOptions;
        }
        if (!$this->widgetClass) {
            throw new InvalidConfigException('Property `widgetClass` must be set');
        }

        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function render()
    {
        if(!$this->access) {
            return null;
        }
        $value = CommonHelper::value($this->value);

        if ($this->disabled) {
            Html::addCssClass($this->options, 'disabled');
            $this->options['disabled'] = true;
        }
        if ($this->name) {
            $this->options['name'] = $this->name;
        }
        $this->options['data-is_dynamic_model'] = Json::encode($this->isDynamicModel);

        return call_user_func([$this->widgetClass, $this->loaderMethod], $value, $this->widgetConfig, $this->options, $this->isDynamicModel, $this->queryParams, $this->wrapper);
    }
}
