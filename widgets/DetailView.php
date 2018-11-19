<?php
namespace app\common\widgets;

use app\common\wrappers\DynamicModal;

/**
 * DetailView
 * @package app\common\widgets
 *
 *
 *
 */
class DetailView extends \yii\widgets\DetailView implements WidgetClientInterface, WrapperAbleInterface
{
    use IdWidgetTrait;
    use WidgetClientTrait;
    use WrapperAbleTrait;

    /**
     * @var array
     */
    public $wrapperOptions;


    /**
     * DetailView constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        if (is_array($config)) {
            $this->setConfig($config);
            parent::__construct($this->getConfig());
        } else {
            parent::__construct();
        }
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        if (empty($this->wrapperOptions)) {
            $this->wrapperOptions = $this->wrapperOptions();
        }
        $this->options['id'] = $this->getId();
        if ($this->clientView) {
            $this->registerClient($this->getId());
        }
    }

    /**
     * @inheritdoc
     */
    public function wrapperOptions()
    {
        return [
            'wrapperClass' => DynamicModal::className(),
        ];
    }
}
