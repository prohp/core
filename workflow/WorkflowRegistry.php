<?php
namespace app\common\workflow;

use app\common\base\Module;

/**
 * Class ServiceRegistry
 *
 *
 * @author Dzhamal Tayibov
 */
class WorkflowRegistry
{
    public static function registry($module, $withNs = false)
    {
        $classes = [];
        /** @var Module $m */
        $m = \Yii::$app->getModule($module);
        if ($m === null) {
            return $classes;
        }
        $dir = $m->getWorkflowPath();
        $ns = $m->getWorkflowNamespace();
        $parentModule = $m->getUniqueId();
        $subModules = $m->getModules();
        if (!empty($subModules)) {
            // recursive
            foreach ($subModules as $subModule => $val) {
                $classes = array_merge($classes, WorkflowRegistry::registry($parentModule . '/' . $subModule, $withNs));
            }
        }
        if (!file_exists($dir)) {
            return $classes;
        }
        $files = scandir($dir);
        foreach ($files as $file) {
            if ($file === '.' || $file === '..' || !is_file($dir . DIRECTORY_SEPARATOR . $file)) {
                continue;
            }
            $f = new \SplFileInfo($dir . DIRECTORY_SEPARATOR . $file);
            if ($f->getExtension() !== 'php') { // php 5.3.6+
                continue;
            }
            $basename = $f->getBasename('.php');
            $class = $ns . '\\' . $basename;
            if ((new \ReflectionClass($class))->isInterface()) {
                continue;
            }
            $withNs ? $classes[] = $class : $classes[] = $basename;
        }
        return $classes;
    }

    public static function getNamespace($module, $className)
    {
        if (class_exists($className)) {
            return $className;
        }
        /** @var Module $m */
        $m = \Yii::$app->getModule($module);
        if ($m === null) {
            throw new \Exception('Модуль не найден.');
        }
        $parentModule = $m->getUniqueId();
        $subModules = $m->getModules();
        if (!empty($subModules)) {
            // recursive
            foreach ($subModules as $subModule => $val) {
                $modelClass = WorkflowRegistry::getNamespace($parentModule . '/' . $subModule, $className);
                if (!class_exists($modelClass)) {
                    continue;
                }
                return $modelClass;
            }
        }
        $workflowNamespace = $m->getWorkflowNamespace();
        $modelClass = $workflowNamespace . '\\' . $className;
        if (!class_exists($modelClass)) {
            return null;
        }
        return $modelClass;
    }
}
