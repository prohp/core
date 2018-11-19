<?php
namespace app\common\base;

use app\common\helpers\ClassHelper;
use yii\helpers\BaseStringHelper;

/**
 * Class UniqueKey
 * @package app\common\base
 *
 * 
 * @author Dzhamal Tayibov
 */
class UniqueKey
{
    /**
     * @param string $prefix
     * @param string $separator
     * @return string
     */
    public static function generate($prefix, $separator = '-')
    {
        return str_replace('.', '', uniqid($prefix . $separator, true));
    }

    /**
     * @param string|object $class
     * @param string $separator
     * @return string
     */
    public static function generateByClass($class, $separator = '-')
    {
        if (is_object($class)) {
            $class = get_class($class);
        } elseif (is_string($class)) {
            $class = ClassHelper::getShortName($class);
        }

        return static::generate(strtolower(BaseStringHelper::basename($class)), $separator);
    }
}
