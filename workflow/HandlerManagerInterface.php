<?php
namespace app\common\workflow;

/**
 * Interface HandlerRegistryInterface
 * @package app\common\workflow
 */
interface HandlerManagerInterface
{
    public function registry($module, $withNs = false);
    public function handlerFactory($module, $handlerType);
}
