<?php
namespace app\common\web;

/**
 * Class AssetBundle
 * 
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
