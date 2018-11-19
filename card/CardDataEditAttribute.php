<?php
namespace app\common\card;

use app\common\db\ActiveRecord;
use app\common\helpers\CommonHelper;
use yii\base\Model;

/**
 * Class CardDataViewAttribute
 * @package app\common\card
 *
 * 
 *
 */
class CardDataEditAttribute extends CardDataAttribute
{
    /**
     * @inheritdoc
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
//        if (!$this->model) {
//            return parent::renderValue();
//        }
        if (!$this->form) {
            throw new \Exception('Form must be initialized on not default scenario.');
        }
        return $this->form
            ->field($this->model, $this->attribute, [
                'enableLabel' => false,
            ])
            ->attributeInput(array_merge($this->inputOptions, []));
    }
}
