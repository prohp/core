<?php
namespace app\common\widgets;

/**
 * Class TimePicker
 * @package app\common\widgets
 *
 * 
 */
class TimePicker extends \kartik\time\TimePicker
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->pluginOptions['showMeridian'] = false;
        parent::init();
    }
}
