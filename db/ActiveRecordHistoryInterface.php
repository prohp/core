<?php
namespace app\common\db;

/**
 * Class ActiveRecordHistoryInterface
 *
 * @todo обновить сигнатуру этого интерфейса по реализованному трейту
 * @author Dzhamal Tayibov
 */
interface ActiveRecordHistoryInterface
{
    public function deleteHistory();
    public function saveHistory($attributes, $tableName);
}
