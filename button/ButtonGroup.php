<?php
namespace app\common\button;

use yii\base\BaseObject;
use app\common\helpers\Html;

/**
 * Компонент для формирования списка кнопок по шаблону
 * Использует компоненты, реализующие ButtonInterface
 *
 * @package app\common\widgets
 *
 *
 * 
 */
class ButtonGroup extends BaseObject
{
    /**
     * @var array Конфигурация кнопок
     */
    public $buttons;
    /**
     * @var string Шаблон кнопки
     */
    public $buttonTemplate;
    /**
     * @var string Класс кнопки по умолчанию (если не передан - будет использован данный класс)
     */
    public $defaultButtonClass = 'app\common\button\Button';
    /**
     * @var array Конфигурация, которая будет передана в класс кнопки
     */
    public $buttonConfig = [];
    /**
     * @var bool Собирать список кнопок в группу?
     */
    public $group = false;
    /**
     * @var array Кастомные опции, которые могут быть установлены у элемента группы (только когда $group === true)
     */
    public $groupOptions = [];
    /**
     * @var array Встроенная конфигурация кнопок для хранения объектов
     */
    private $_buttons;


    /**
     * Формируем объекты на основе конфигурации
     */
    public function init()
    {
        foreach ($this->buttons as $key => $value) {
	        if (is_array($value) && !is_numeric($key)) {
		        $value = array_merge(['name' => $key], $value);
	        }
            $this->_buttons[$key] = $this->buildButton($value);
        }

        parent::init();
    }

    /**
     * Построить экземпляр кнопки по конфигурации
     * Либо подставить конфигурацию по умолчанию
     * @param $value
     * @return object
     */
    protected function buildButton($value)
    {
        if (!is_array($value)) {
            return null;
        }

        $config = array_merge($value, $this->buttonConfig);

        if (!isset($config['class'])) {
            $config['class'] = $this->defaultButtonClass;
        }

        return \Yii::createObject($config);
    }

    /**
     * Отрендерить группу кнопок по шаблону
     */
    public function render()
    {
        $output = '';
        $output .= preg_replace_callback('/\\{([АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЬЫЪЭЮЯабвгдеёжзийклмнопрстуфхцчшщьыъэюя \w\-\/]+)\\}/', function ($matches) {
            $output = '';
            $buttonTemplate = str_replace('{', '', $matches[0]);
            $buttonTemplate = str_replace('}', '', $buttonTemplate); // todo оптимизировать в replacement
            if (isset($this->buttons[$buttonTemplate]) && isset($this->_buttons[$buttonTemplate]) && $this->_buttons[$buttonTemplate] instanceof ButtonInterface) {
                $output .= $this->_buttons[$buttonTemplate]->render();
                $output .= ' ';
                return $output;
            }
        }, $this->buttonTemplate);
        if ($this->group === true) {
            $output = Html::beginTag('div', array_merge([
                'class' => 'btn-group',
                'role' => 'group',
                'aria-label' => '',
            ], $this->groupOptions)) . $output . Html::endTag('div');
        }

        return $output;
    }
}
