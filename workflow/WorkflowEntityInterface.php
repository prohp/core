<?php
namespace app\common\workflow;

/**
 * Domain Layer
 * Interface WorkflowEntityInterface
 * @package app\common\workflow
 *
 * @author Dzhamal Tayibov
 */
interface WorkflowEntityInterface
{
    public function getStatusName();
    public static function statuses();
}
