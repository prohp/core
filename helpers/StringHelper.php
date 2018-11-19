<?php
namespace app\common\helpers;

/**
 * Class StringHelper
 *
 */
class StringHelper extends \yii\helpers\StringHelper
{
    /**
     * @param string $st
     * @return string
     */
    public static function transliterate($st)
    {
        $st = strtr(($st),
            "абвгдежзийклмнопрстуфхыэ",
            "abvgdegziyklmnoprstufhie"
        );
        $st = strtr($st, [
            'ё'=>"yo",      'ц'=>"ts",  'ч'=>"ch",  'ш'=>"sh",
            'щ'=>"shch",    'ъ'=>"",    'ь'=>"",    'ю'=>"yu",
            'я'=>"ya",
        ]);

        return $st;
    }

    /**
     * Форматирует и конвертирует кол-во байт, возвращает строку
     *
     * Например: 9.54 MB
     *
     * @param $bytes
     * @param int $precision
     * @return string
     */
    public static function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);
        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}
