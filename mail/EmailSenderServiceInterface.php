<?php
namespace app\common\mail;

/**
 * Interface EmailSenderServiceInterface
 *
 */
interface EmailSenderServiceInterface
{
    public function sendMessageEmail($to, $subject, $content);
}
