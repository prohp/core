<?php
namespace app\common\widgets;

/**
 * Class WrapperTrait
 *
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
