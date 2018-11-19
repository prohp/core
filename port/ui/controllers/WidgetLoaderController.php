<?php
namespace app\common\port\ui\controllers;

use app\common\filters\QueryParamAuth;
use app\common\web\Controller;
use app\common\widgets\WidgetFactory;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;
use yii\web\HttpException;

/**
 * Class WidgetLoaderController
 * @package app\port\ui\controllers
 *
 * @author Dzhamal Tayibov
 */
class WidgetLoaderController extends Controller
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

    public function actionFactory()
    {
        $viewParams = \Yii::$app->request->getBodyParams();
        if (empty($viewParams['module'])) {
            $viewParams['module'] = WidgetFactory::BASIC_MODULE_NAME;
        }
        if (!isset($viewParams['className'])) {
            throw new HttpException(400, 'Отсутствуют обязательные параметры: module, className');
        }
        return $this->asJson([
            'html' => $this->renderAjaxContent(WidgetFactory::createWidget($viewParams))
        ]);
    }

    /**
     * @param string $content
     * @return string
     */
    private function renderAjaxContent($content)
    {
        $view = $this->getView();
        ob_start();
        ob_implicit_flush(false);
        $view->beginPage();
        $view->head();
        $view->beginBody();
        echo $content;
        $view->endBody();
        $view->endPage(true);
        return ob_get_clean();
    }
}
