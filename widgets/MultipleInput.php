<?php
namespace app\common\widgets;

/**
 * Class MultipleInput
 * @package app\common\widgets
 *
 * 
 */
class MultipleInput extends \unclead\multipleinput\MultipleInput
{
    use IdWidgetTrait;

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->attributeOptions = [
            'enableAjaxValidation' => true,
            'enableClientValidation' => true,
            'validateOnChange' => true,
            'validateOnSubmit' => true,
            'validateOnBlur' => true,
        ];
        $this->options['id'] = $this->getId();
        parent::init();
    }
}
