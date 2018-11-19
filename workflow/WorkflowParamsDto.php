<?php
namespace app\common\workflow;

/**
 * Class WorkflowParamsDto
 * 
 *
 * @author Dzhamal Tayibov
 */
class WorkflowParamsDto
{
    private $ormModule;
    private $ormClass;
    private $ormId;
    private $transitionName;

    public function __construct($ormModule, $ormClass, $ormId, $transitionName)
    {
        $this->ormModule = $ormModule;
        $this->ormClass = $ormClass;
        $this->ormId = $ormId;
        $this->transitionName = $transitionName;
    }

    public function getOrmModule()
    {
        return $this->ormModule;
    }

    public function getOrmClass()
    {
        return $this->ormClass;
    }

    public function getOrmId()
    {
        return $this->ormId;
    }

    public function getTransitionName()
    {
        return $this->transitionName;
    }
}
