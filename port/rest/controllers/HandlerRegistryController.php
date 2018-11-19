<?php
namespace app\common\port\rest\controllers;

use app\common\filters\QueryParamAuth;
use app\common\rest\Controller;
use app\common\workflow\HandlerManagerInterface;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

/**
 * Class HandlerRegistryController
 *
 */
class HandlerRegistryController extends Controller
{
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

    public function actionHandlerRegistry($module, $handlerType)
    {
        return $this->asJson(\Yii::$container
            ->get(HandlerManagerInterface::class)
            ->registryMethods($module, $handlerType));
    }
}
