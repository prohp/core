<?php
namespace app\common\workflow;

use app\common\acl\ApplicationResourceTrait;
use app\common\acl\resource\ApplicationResourceInterface;
use app\common\service\ApplicationServiceInterface;
use Symfony\Component\Workflow\Transition;

/**
 * Class StateMachine
 * 
 *
 * @author Dzhamal Tayibov
 */
class StateMachine extends \Symfony\Component\Workflow\StateMachine implements ApplicationResourceInterface
{
    use ApplicationResourceTrait;

    /**
     * @inheritdoc
     */
//    public function can($subject, $transitionName)
//    {
//        if (!$this->isAllowed($transitionName)) {
//            // todo писать лог
//            return false;
//        }
//        return parent::can($subject, $transitionName);
//    }

//    /**
//     * @inheritdoc
//     */
//    public function getEnabledTransitions($subject)
//    {
//        $transitions = parent::getEnabledTransitions($subject);
//        if (empty($transitions)) {
//            return $transitions;
//        }
//        foreach ($transitions as $key => $transition) {
//            if (!$this->isAllowed($transition->getName())) {
//                // todo писать лог
//                unset($transitions[$key]);
//            }
//        }
//        if (!isset($transitions)) {
//            return [];
//        }
//        return $transitions;
//    }

    /**
     * @inheritdoc
     */
    public function getPrivileges()
    {
        $privileges = [];
        $transitions = $this->getDefinition()->getTransitions();
        if (empty($transitions)) {
            return $privileges;
        }
        foreach ($transitions as $transition) {
            if (!$transition instanceof Transition) {
                continue; // or ERROR
            }
            $privileges[$transition->getName()] = \Yii::t('app', $transition->getName());
        }
        return $privileges;
    }
}
