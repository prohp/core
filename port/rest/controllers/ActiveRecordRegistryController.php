<?php
namespace app\common\port\rest\controllers;

use app\common\db\ActiveRecordRegistry;
use app\common\filters\QueryParamAuth;
use app\common\rest\Controller;
use yii\base\Module;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

/**
 * @todo этот контроллер доступен суперпользователю по умолчанию.
 * Class ActiveRecordRegistryController
 * @package app\port\rest\controllers
 *
 * @author Dzhamal Tayibov
 */
class ActiveRecordRegistryController extends Controller
{
    /**
     * @var ActiveRecordRegistry
     */
    public $registry;

    /**
     * ActiveRecordRegistryController constructor.
     * @param string $id
     * @param Module $module
     * @param ActiveRecordRegistry $registry
     * @param array $config
     */
    public function __construct($id, Module $module, ActiveRecordRegistry $registry, array $config = [])
    {
        $this->registry = $registry;
        parent::__construct($id, $module, $config);
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'authenticator' => [
                'class' => QueryParamAuth::class,
                'isSession' => false,
                'optional' => [
                    '*',
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
                'denyCallback' => function () {
                    throw new ForbiddenHttpException(\Yii::t('yii', 'You are not allowed to perform this action.'));
                }
            ],
        ]);
    }
    
    public function actionRegistry($module)
    {
        return $this->asJson(ActiveRecordRegistry::registry($module));
    }
}
