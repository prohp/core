<?php
namespace app\common\workflow;

use app\common\base\Module;
use yii\base\InvalidValueException;

/**
 * Class HandlerRegistry
 * @package app\common\workflow
 * @author Dzhamal Tayibov
 */
class HandlerManager implements HandlerManagerInterface
{
    public function handlerFactory($module, $handlerType)
    {
        $m = \Yii::$app->getModule($module);
        if ($m === null) {
            throw new InvalidValueException('Модуль не найден.');
        }
        $handlerNs = $m->getWorkflowHandlerNamespace();
        $modelClass = $handlerNs . '\\' . $handlerType;
        if (!interface_exists($modelClass)) {
            throw new \Exception('Handler type not found.');
        }
        return $modelClass;
    }

    public function registryMethods($module, $handlerType)
    {
        /** @var Module $m */
        $m = \Yii::$app->getModule($module);
        if ($m === null) {
            throw new InvalidValueException('Модуль не найден.');
        }
        $handlerNs = $m->getWorkflowHandlerNamespace();
        $modelClass = $handlerNs . '\\' . $handlerType;
//        if (interface_exists($modelClass)) {
//            return $modelClass;
//        }
        if (!interface_exists($modelClass)) {
            throw new \Exception('Не удалось найти type ' . $modelClass);
        }
        $methods = (new \ReflectionClass($modelClass))->getMethods(\ReflectionMethod::IS_ABSTRACT);
        foreach ($methods as $key => $method) {
            $methods[$key] = $method->getName();
        }
        return array_combine($methods, $methods);
    }

    public function registry($module, $withNs = false)
    {
        $classes = [];
        /** @var Module $m */
        $m = \Yii::$app->getModule($module);
        if ($m === null) {
            return $classes;
        }
        $dir = $m->getWorkflowHandlerPath();
        $ns = $m->getWorkflowHandlerNamespace();
        $parentModule = $m->getUniqueId();
        $subModules = $m->getModules();
        if (!empty($subModules)) {
            // recursive
            foreach ($subModules as $subModule => $val) {
                $classes = array_merge($classes, $this->registry($parentModule . '/' . $subModule, $withNs));
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
            if (!(new \ReflectionClass($class))->isInterface()) {
                continue;
            }
            $withNs ? $classes[$class] = $class : $classes[$basename] = $basename;
        }
        return $classes;
    }
}
