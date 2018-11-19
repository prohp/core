<?php
namespace app\common\bots;

/**
 * Interface SkypeBotServiceInterface
 *
 *
 * @author Dzhamal Tayibov
 */
interface SkypeBotServiceInterface
{
    public function sendMessageWithoutRequest($to, $content, $serviceUrl);

    /**
     * @return array
     */
    public function getSkypeToken();

    /**
     * Газлклиент отправляет запрос к скайп-боту с сообщением или с отчетом
     * @param array $authData
     * @param string $responseActivityRequestUrl
     * @param array $responseActivity
     */
    public function clientActivityRequest($authData, $responseActivityRequestUrl, $responseActivity);
}
