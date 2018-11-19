<?php
namespace app\common\button;

use app\common\helpers\Html;
use yii\base\BaseObject;

/**
 * Кнопка
 * @package app\common\button
 *
 * @property $disabled
 *
 * 
 * @author Dzhamal Tayibov
 */
class Button extends BaseObject implements ButtonInterface
{
    /**
     * @var string|array|callable
     */
    public $value;
    /**
     * @var string Имя кнопки (действие)
     */
    public $name;
    /**
     * @var array
     */
    public $options = [];
    /**
     * @var boolean whether this column is visible. Defaults to true.
     */
    public $disabled = true;


    /**
     * @return mixed
     */
    public function render()
    {
        if ($this->value instanceof \Closure) {
            return call_user_func($this->value, $this->disabled, $this->options);
        }
        // todo Добавить формирование в зависимости от типа кнопки
        return Html::button($this->value, [
            'disabled' => $this->disabled,
            'class' => $this->options['class'],
            'icon' => $this->options['icon'],
        ]);
    }
}
