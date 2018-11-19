<?php
namespace app\common\web;

/**
 * Class AssetBundle
 * @package common\web
 *
 * 
 */
class AssetBundle extends \yii\web\AssetBundle
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->publishOptions['forceCopy'] = YII_DEBUG;
        parent::init();
    }
}
