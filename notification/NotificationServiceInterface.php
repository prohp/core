<?php
namespace app\common\notification;

/**
 * Interface NotificationServiceInterface
 * @package app\common\notification
 *
 * @author Dzhamal Tayibov
 */
interface NotificationServiceInterface
{
    public function save($message, $type, $to);
    public function sendAll($type);
}
