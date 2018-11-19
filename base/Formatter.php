<?php
namespace app\common\base;

/**
 * Class Formatter
 * @package app\common\base
 *
 * 
 */
class Formatter extends \yii\i18n\Formatter
{
    /**
     * @var string
     */
    public $nullDisplay = '';
    /**
     * @var int
     */
    public $sizeFormatBase = 1024;
}
