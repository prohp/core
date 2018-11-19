<?php
namespace app\common\widgets;

/**
 * Class WrapperTrait
 * @package app\common\widgets
 *
 * @author Dzhamal Tayibov
 */
trait WrapperAbleTrait
{
    /**
     * @var bool
     */
    public $wrapper = false;


    /**
     * @return array
     */
    public function wrapperOptions()
    {
        return [];
    }
}
