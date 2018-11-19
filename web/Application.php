<?php
namespace app\common\web;

use app\common\base\ModuleTrait;
use app\common\config\ConfigManager;

/**
 * Class Application
 *
 * @property-read ConfigManager $configManager
 *
 * @package app\common\web
 *
 * @author Dzhamal Tayibov
 */
class Application extends \yii\web\Application
{
    use ModuleTrait;

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->controllerNamespace = 'app\common\port';
        $this->_widgetNamespace = 'app\widgets';
        $this->_ormNamespace = 'app\models\orm';
        $this->_workflowNamespace = 'app\workflow';
        $this->_applicationNamespace = 'app\application';
        $this->_workflowHandlerNamespace = 'app\handlers';
        if ($this->dynamicModule) {
            $this->setDynamicModules($this->dynamicModuleDI);
        }
        parent::init();
    }
}
