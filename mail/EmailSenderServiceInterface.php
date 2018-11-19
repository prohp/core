<?php
namespace app\common\mail;

/**
 * Interface EmailSenderServiceInterface
 * @package app\common\core\mail
 */
interface EmailSenderServiceInterface
{
    public function sendMessageEmail($to, $subject, $content);
}
