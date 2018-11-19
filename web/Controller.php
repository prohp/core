<?php
namespace app\common\web;

use app\common\helpers\ClientHelper;
use yii\filters\AccessControl;
use yii\filters\ContentNegotiator;

/**
 * Class Controller
 * @todo Trait, который будет менять path VIEW в зависимости от порта
 * @package app\common\web
 *
 * @author Dzhamal Tayibov
 */
class Controller extends \yii\web\Controller
{
    const TYPE_SUCCESS = 1;
    const TYPE_WARNING = 2;
    const TYPE_ERROR = 3;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'contentNegotiator' => [
                'class' => ContentNegotiator::class,
                'formats' => [
                    'text/html' => Response::FORMAT_HTML,
                    'application/json' => Response::FORMAT_JSON,
                    'application/xml' => Response::FORMAT_XML,
                ],
            ],
        ]);
    }

    public function init()
    {
        parent::init();
        if (!$this->getBehavior('access')) {
            $this->attachBehavior('access', [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ]
            ]);
        }
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

//    /**
//     * @param string $content
//     * @return string
//     */
//    public function renderAjaxContent($content)
//    {
//        $view = $this->getView();
//        ob_start();
//        ob_implicit_flush(false);
//        $view->beginPage();
//        $view->head();
//        $view->beginBody();
//        echo $content;
//        $view->endBody();
//        $view->endPage(true);
//        return ob_get_clean();
//    }

    /**
     * @param string $message
     * @param int $type
     * @return string
     */
    public static function success($message, $type = self::TYPE_SUCCESS)
    {
        return static::asJson(ClientHelper::messageFactory($message, $type));
    }

    /**
     * @param string $message
     * @param int $type
     * @return string
     */
    public static function warning($message, $type = self::TYPE_WARNING)
    {
        return static::asJson(ClientHelper::messageFactory($message, $type));
    }

    /**
     * @param string $message
     * @param int $type
     * @return string
     */
    public static function error($message, $type = self::TYPE_ERROR)
    {
        return static::asJson(ClientHelper::messageFactory($message, $type));
    }
}
