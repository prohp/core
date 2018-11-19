<?php
namespace app\common\acl;

use app\common\helpers\ClassHelper;
use app\common\service\ApplicationServiceInterface;
use app\common\service\ServiceRegistry;

/**
 * Class Acl
 *
 */
class Acl extends \Zend\Permissions\Acl\Acl
{
    const TYPE_SERVICE = 1;

    public function getResourceClass($module, $className, $aclType)
    {
        if (class_exists($className)) {
            return $className;
        }
        $m = \Yii::$app->getModule($module);
        if ($m === null) {
            throw new \Exception('Модуль не найден.');
        }
        $parentModule = $m->getUniqueId();
        $subModules = $m->getModules();
        if (!empty($subModules)) {
            // recursive
            foreach ($subModules as $subModule => $val) {
                if ($aclType === self::TYPE_SERVICE) {
                    $modelClass = ServiceRegistry::getNamespace($parentModule . '/' . $subModule, $className);
                }
//                elseif ($aclType === Acl::TYPE_WORKFLOW) {
//                    $modelClass = WorkflowRegistry::getNamespace($parentModule . '/' . $subModule, $className);
//                }
                if (!class_exists($modelClass)) {
                    continue;
                }
                return $modelClass;
            }
        }
        if ($aclType === self::TYPE_SERVICE) {
            $serviceNamespace = $m->getApplicationNamespace();
        }
//        elseif ($aclType === AclOrm::TYPE_WORKFLOW) {
//            $serviceNamespace = $m->getWorkflowNamespace();
//        }
        $modelClass = $serviceNamespace . '\\' . $className;
        if (!class_exists($modelClass)) {
            return null;
        }
        return $modelClass;
    }

    /**
     * @param string $module
     * @param int $aclType
     * @return array
     * @throws \Exception
     */
    public function resourceRegistry($module, $aclType)
    {
        $services = [];
        if ($aclType === self::TYPE_SERVICE) {
            $services = ServiceRegistry::registry($module, false);
        }
//        elseif ($aclType === self::TYPE_WORKFLOW) {
//            $services = WorkflowRegistry::registry($module, false);
//        }
        $aliases = [];
        foreach ($services as $entityType) {
            $service = '';
            if ($aclType === self::TYPE_SERVICE) {
                $service = ServiceRegistry::getNamespace($module, $entityType);
            }
//            elseif ($aclType === self::TYPE_WORKFLOW) {
//                $service = WorkflowRegistry::getNamespace($module, $entityType);
//            }
            if (!class_exists($service)) {
                throw new \Exception('Класс не найден.');
            }
            if (!ClassHelper::implementsInterface($service, ApplicationServiceInterface::class)) { // @todo ресурс не только Application
                continue;
            }
            $aliases[$entityType] =  \Yii::createObject($service)->aclAlias();
        }
        return $aliases;
    }
}
