<?php
namespace app\common\workflow;

/**
 * Domain Layer
 * Interface WorkflowEntityInterface
 *
 *
 * @author Dzhamal Tayibov
 */
interface WorkflowEntityInterface
{
    public function getStatusName();
    public static function statuses();
}
