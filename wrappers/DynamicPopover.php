<?php
namespace app\common\wrappers;

use app\common\widgets\Popover;

/**
 * Class DynamicPopover
 * @package app\common\wrappers
 *
 * 
 */
class DynamicPopover extends Popover implements WrapperInterface
{
    use WrapperTrait;

    /**
     * @var bool
     */
    public $clientView = true;
    /**
     * @var bool
     */
    public $clientWrapperContainer = true;
    /**
     * @var bool
     */
    public $clientParams = true;


    /**
     * @inheritdoc
     */
    public function init()
    {
        if ($this->selector) {
            $id = '#' . $this->selector;
        } else {
            $id = '#' . $this->id;
        }
        $this->clientViewOptions['selector'] = $id;
        parent::init();
        $this->injectWrapperOptions();
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        echo $this->renderContent();
        parent::run();
    }
}
