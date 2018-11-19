<?php
namespace app\common\widgets;

/**
 * Class TimePicker
 *
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
