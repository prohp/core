<?php
namespace app\common\workflow;

use app\common\helpers\ClassHelper;
use app\modules\config\application\WorkflowStatusServiceInterface;

/**
 * Trait WorkflowEntityTrait
 * @package app\common\workflow
 *
 * @author Dzhamal Tayibov
 */
trait WorkflowEntityTrait
{
    /**
     * @return string
     */
    public function getStatusName()
    {
        $statuses = static::statuses();
        return isset($statuses[$this->status]) ? $statuses[$this->status] : null;
    }

    /**
     * @todo Слой ниже дёргает слой выше... что-то тут не так, но пока времени нет
     */
    public function getStartStatus()
    {
        /** @var WorkflowStatusServiceInterface $service */
        $service = \Yii::$container->get(WorkflowStatusServiceInterface::class);
        return $service
            ->getStartStatusByEntity(
                ClassHelper::getMatchModule(static::class, false),
                ClassHelper::getShortName(static::class)
            );
    }

    /**
     * @todo Слой ниже дёргает слой выше... что-то тут не так, но пока времени нет
     */
    public static function statuses()
    {
        /** @var WorkflowStatusServiceInterface $service */
        $service = \Yii::$container->get(WorkflowStatusServiceInterface::class);
        return $service
            ->getWorkflowStatusesByEntity(
                ClassHelper::getMatchModule(static::class, false),
                ClassHelper::getShortName(static::class)
            );
    }
}
