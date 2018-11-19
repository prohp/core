<?php
namespace app\common\workflow;

/**
 * Class Transition
 * @package app\common\workflow
 */
class Transition extends \Symfony\Component\Workflow\Transition
{
    private $middleWare;

    public function __construct(string $name, $froms, $tos, $middleware)
    {
        parent::__construct($name, $froms, $tos);
        $this->middleWare = $middleware;
    }

    public function getMiddleware()
    {
        return $this->middleWare;
    }
}
