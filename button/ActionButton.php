<?php
namespace app\common\button;

use app\common\helpers\CommonHelper;
use yii\base\InvalidConfigException;
use yii\base\Widget;

/**
 * Class CaptionButton
 * @package app\common\grid\caption
 *
 * @author Dzhamal Tayibov
 */
class ActionButton extends Button
{ // todo confirm сюда, а не в linkAction
    /**
     * @var Widget
     */
    public $afterUpdateBlock;
    /**
     * @var boolean whether this button is not able. Defaults to true.
     */
    public $access = true;
    /**
     * @var bool
     */
    public $isDynamicModel = true;
    /**
     * @var string
     */
    public $queryParams;
    /**
     * @var string
     */
    public $primaryAttribute = 'id';


    /**
     * @inheritdoc
     */
    public function init()
    {
        if (isset($this->afterUpdateBlock) && !($this->afterUpdateBlock instanceof Widget)) {
            throw new InvalidConfigException('Invalid afterUpdateBlock in ActionButton.');
        }
    }

    /**
     * @return mixed
     */
    public function render()
    {
        $this->value = CommonHelper::value($this->value, $this->disabled);

        if ($this->name && is_string($this->value) && strpos('name=', $this->value) === false) {
            $this->value = preg_replace('/<(a|button)/', "<$1 name=\"{$this->name}\"", $this->value);
        }

        return $this->value;
    }
}
