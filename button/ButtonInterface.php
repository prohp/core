<?php
namespace app\common\button;

/**
 * Интерфейс кнопки
 * @package app\common\button
 *
 * 
 */
interface ButtonInterface
{
    /**
     * Отрисовать содержимое
     * @return mixed
     */
    public function render();
}
