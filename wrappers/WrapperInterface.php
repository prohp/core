<?php
namespace app\common\wrappers;

/**
 * Interface WrapperAbleInterface
 * @package app\common\wrappers
 *
 * @author Dzhamal Tayibov
 */
interface WrapperInterface
{
    /**
     * @return mixed
     */
    public function injectWrapperOptions();

    /**
     * @return mixed
     */
    public function renderContent();
}
