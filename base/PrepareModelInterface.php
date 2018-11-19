<?php
namespace app\common\base;

/**
 * Interface PrepareModelInterface
 * @package app\common\db
 *
 * @author Dzhamal Tayibov
 */
interface PrepareModelInterface
{
    /**
     * Подготовить модель из различных данных
     * @param mixed $model
     * @param string $scenario
     * @param array $data
     * @return mixed
     */
    public static function ensure($model, $scenario, $data = []);
}
