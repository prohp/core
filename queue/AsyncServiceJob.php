<?php
namespace app\common\queue;

use yii\queue\JobInterface;

/**
 * Class AsyncServiceJob
 * @package app\common\queue
 */
class AsyncServiceJob implements JobInterface
{
    private $serviceInterface;
    private $method;
    /**
     * [ value1, value2 ... ]
     * @var array
     */
    private $params = [];

    public function __construct($serviceInterface, $method, $params)
    {
        $this->serviceInterface = $serviceInterface;
        $this->method = $method;
        $this->params = $params;
    }

    /**
     * {@inheritdoc}
     */
    public function execute($queue)
    {
        $service = \Yii::createObject($this->serviceInterface); // DI wrapper
        if (method_exists($service, $this->method)) {
            call_user_func_array([$service, $this->method], $this->params);
        }
    }
}
