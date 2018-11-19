<?php
namespace app\common\wrappers;

/**
 * Interface WrapperAbleInterface
 * 
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
