<?php
namespace app\common\widgets;

/**
 * Class Dialog
 * @package app\common\widgets
 *
 * 
 */
class Dialog extends \yii\jui\Dialog
{
    use IdWidgetTrait;

    public function init()
    {
        $this->options['id'] = $this->getId();
        parent::init();
    }
}
