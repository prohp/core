<?php
namespace app\common\workflow;

/**
 * Interface WorkflowManagerService
 *
 *
 * @author Dzhamal Tayibov
 */
interface WorkflowManagerInterface
{
    public function applyTransition(WorkflowParamsDto $dto);
    public function stateMachineFactory($ormModule, $ormClass, $entityId);
    public function definitionFactory($workflowId);
}
