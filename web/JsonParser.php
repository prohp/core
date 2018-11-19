<?php
namespace app\common\web;

use app\common\helpers\Json;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;

/**
 * Class JsonParser
 *
 *
 * 
 */
class JsonParser extends \yii\web\JsonParser
{
    /**
     * @inheritdoc
     */
    public function parse($rawBody, $contentType)
    {
        try {
            $parameters = Json::decode($rawBody, $this->asArray, 512, JSON_BIGINT_AS_STRING);
            return $parameters === null ? [] : $parameters;
        } catch (InvalidParamException $e) {
            if ($this->throwException) {
                throw new BadRequestHttpException('Invalid JSON data in request body: ' . $e->getMessage());
            }
            return [];
        }
    }
}
