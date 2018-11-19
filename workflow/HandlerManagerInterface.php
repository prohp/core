<?php
namespace app\common\workflow;

/**
 * Interface HandlerRegistryInterface
 *
 */
interface HandlerManagerInterface
{
    public function registry($module, $withNs = false);
    public function handlerFactory($module, $handlerType);
}
