<?php
namespace app\common\card;

use app\common\db\ActiveRecord;
use app\common\helpers\CommonHelper;
use app\common\widgets\ActiveForm;
use yii\base\Model;
use yii\base\BaseObject;
use app\common\helpers\Html;
use yii\helpers\ArrayHelper;

/**
 * Class CardDataAttribute
 * 
 *
 *
 */
abstract class CardDataAttribute extends BaseObject
{
    const LABEL_COL_SIZE = '4';
    const VALUE_COL_SIZE = '8';

    /**
     * @var Model
     */
    public $model;
    /**
     * @var
     */
    public $attribute;
    /**
     * @var \Closure|string Значение атрибута, может задаваться в виде замыкания, в него будет передана модель
     */
    public $value;
    /**
     * @var \Closure|string Надпись атрибута, может задаваться в виде замыкания, в него будет передана модель
     */
    public $label;
    /**
     * @var string Тип атрибута, может использоваться для шаблонного форматирования по типу атрибута
     */
    public $type;
    /**
     * @var int $count Количество элементов в контейнере, где живёт текущий элемент
     */
    public $count;
	/**
	 * @var ActiveForm
	 */
    public $form;
    /**
     * @var int Размер колонки по бутстрапу
     */
    public $colSize;
    /**
     * @var int Размер колонки с лабелем
     */
    public $labelSize;
    /**
     * @var int Размер колонки с полями для ввода
     */
    public $valueSize;
    /**
     * @todo это поле реально используется только в [[CardDataEditAttribute]], перенести туда, если на просмотре не
     * будет инпутов
	 * @var array Опции поля формы
	 */
	public $inputOptions = [];
	/**
	 * @var bool
	 */
	public $multiline = false;


    public function render()
    {
	    $label = $this->renderLabel();
	    $value = $this->renderValue();
	    if (!isset($label) && !isset($value)) {
		    return null;
	    }
        echo Html::beginTag('div', ['class' => 'row form-group']);
	        echo Html::beginTag('div', ['class' => 'text-right col-md-' . (isset($this->labelSize) && $this->checkSizes() ? $this->labelSize : $this::LABEL_COL_SIZE)]); //todo сделать с этим ченить $this->getLabelColSize()
			    if ($label) {
			        $labelOptions = [];
			        if ($this->model->scenario !== Model::SCENARIO_DEFAULT && $this->model->isAttributeRequired($this->attribute)) {
			            Html::addCssClass($labelOptions, ActiveForm::REQUIRED_CLASS);
                    }
                    Html::addCssClass($labelOptions, 'text-muted control-label attribute-label');
				    echo Html::tag('label', $label, $labelOptions);
			    }
	        echo Html::endTag('div');
	        echo Html::beginTag('div', ['class' => 'col-md-' . (isset($this->labelSize) && $this->checkSizes() ? $this->valueSize : $this::VALUE_COL_SIZE)]); //todo сделать с этим ченить $this->getValueColSize()
	            if (is_array($value)) {
                    echo Html::ul($value);
                } else {
                    echo Html::tag('div', $value, [
                        'class' => 'attribute-value' . ($this->multiline ? '' : ' attribute-value-line'),
                        'title' => $this->multiline ? false : strip_tags($value),
                    ]);
                }
	        echo Html::endTag('div');
        echo Html::endTag('div');
    }

    /**
     * @return bool
     */
    protected function checkSizes()
    {
        $check = false;
        $sum = $this->labelSize + $this->valueSize;
        if ($sum > 0 && $sum <= 12) {
            $check = true;
        }
        return $check;
    }

    /**
     * Получить Bootstrap col-размер для лейбла атрибута
     * Используется для адаптации блока под строку
     * @return integer
     */
    protected function getLabelColSize()
    {
        return 12 - $this->getValueColSize();
    }

    /**
     * Получить Bootstrap col-размер для значения атрибута
     * Используется для адаптации блока под строку
     * @return integer
     */
    protected function getValueColSize()
    {
        switch ($this->count) {
            case 1:
                return 10;
            case 2:
                return 8;
            default:
                return 6;
        }
    }

    public function renderLabel()
    {
        if ($this->label === false) {
            return null;
        }
        if ($this->label instanceof \Closure) {
            return call_user_func($this->label, $this->model);
        }
        if (isset($this->label) && strlen($this->label) > 0) {
            return $this->label;
        }
        if ($this->model instanceof Model) {
            return $this->model->getAttributeLabel($this->attribute);
        }
        return false;
    }

	/**
	 * @return string
     * @todo сделать метод абстрактным и перенести его во CardDataViewAttribute
	 */
    public function renderValue()
    {
        if ($this->value === false) {
            return null;
        }
	    $value = CommonHelper::value($this->value, $this->model, $this->form);
	    if ($value !== null) {
		    return $value;
	    }
	    if (!empty($this->attribute)) {
            $value = ArrayHelper::getValue($this->model, $this->attribute);
        }
	    if ($this->model instanceof ActiveRecord && $this->model->isDate($this->attribute)) {
		    $value = $this->model->dateFormat($this->attribute);
	    }

	    return $value;
    }
}
