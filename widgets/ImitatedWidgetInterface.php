<?php
namespace app\common\widgets;

/**
 * Interface ImitatedWidgetInterface
 *
 * @package app\common\widgets
 *
 * 
 */
interface ImitatedWidgetInterface
{
    /**
     * Имитировать работу виджета - виджет должен отключить все управляющие элементы и показать пустые данные
     *
     * @return void
     */
    public function imitate();
}
