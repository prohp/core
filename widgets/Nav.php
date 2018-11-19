<?php
namespace app\common\widgets;

/**
 * Class Nav
 *
 *
 * 
 */
class Nav extends \yii\bootstrap\Nav
{
//    use IdWidgetTrait;
//
    public $activateParents = true;
//
//    public function init()
//    {
//        parent::init();
//    }
//
//    public function run()
//    {
////        if (!\Yii::$app->user->isGuest) {
//            return parent::run();
////        }
//    }

    protected function isItemActive($item)
    {
        if (isset($item['url']) && is_array($item['url']) && isset($item['url'][0])) {
            $route = $item['url'][0];
            if ($route[0] !== '/' && \Yii::$app->controller) {
                $route = \Yii::$app->controller->module->getUniqueId() . '/' . $route;
            }
            if (ltrim($route, '/') !== $this->route) {
                return false;
            }
            unset($item['url']['#']);
            if (count($item['url']) > 1) {
                $params = $item['url'];
                unset($params[0]);
                foreach ($params as $name => $value) {
                    if ($value !== null && (!isset($this->params[$name]) || $this->params[$name] != $value)) {
                        return false;
                    }
                }
            }

            return true;
        }

        return false;
    }

    /**
     * @override
     * @param array $item
     * @return bool
     */
//    protected function isItemActive($item)
//    {
//        $defaultRoute = \Yii::$app->defaultRoute;
//        $urlManagerRules = \Yii::$app->urlManager->rules;
//        $routeOverride = null;
//
//        foreach ($urlManagerRules as $rule) {
//            if ($rule->route == $this->route) {
//                $routeOverride = $rule->name;
//            }
//        }
//
//        if (isset($item['url']) && is_array($item['url']) && isset($item['url'][0])) {
//            $route = $item['url'][0];
//            $urlParamsString = "";
//            if (count($item['url']) > 1) {
//                $i = 0;
//                $urlParamsString .= "?";
//                foreach ($item['url'] as $key => $val) {
//                    if ($i == 0) {
//                        $i++;
//                    } else {
//                        $urlParamsString .= $key . "=" . $val . "&";
//                    }
//                }
//                $urlParamsString = rtrim($urlParamsString, "&");
//            }
//
//            $override = false;
//            if (ltrim($route, '/') == $routeOverride || ltrim($route, '/') . '/index' == $this->route) {
//                return true;
//            }
//
//            $urlParts = explode("/" ,ltrim($route, '/'));
//            $routeParts = explode("/" , $this->route);
//            $routeParamsString = "";
//            if (is_array($this->params) && count($this->params) > 0) {
//                $routeParamsString .= "?";
//                foreach ($this->params as $key => $val) {
//                    $routeParamsString .= $key . "=" . $val . "&";
//                }
//                $routeParamsString = rtrim($routeParamsString, "&");
//            }
//
//            if (count($urlParts) == 2) {
//                $urlParts[2] = 'index';
//            }
//            if (count($urlParts) == 3) {
//                if ($routeParts[2] == "view" && $urlParamsString == "" && $urlParts[0] == $routeParts[0] && $urlParts[1] == $routeParts[1]) {
//                    return true;
//                }
//                if(($urlParts[0] == $routeParts[0] && $urlParts[1] == $routeParts[1] && $urlParts[2] == $routeParts[2]) && $routeParamsString == $urlParamsString) {
//                    return true;
//                }
//            }
//
//
//            if ($route[0] !== '/' && \Yii::$app->controller) {
//                $route = \Yii::$app->controller->module->getUniqueId() . '/' . $route;
//            }
//            if (ltrim($route, '/') !== $this->route) {
//                return false;
//            }
//            unset($item['url']['#']);
//            if (count($item['url']) > 1) {
//                $params = $item['url'];
//                unset($params[0]);
//                foreach ($params as $name => $value) {
//                    if ($value !== null && (!isset($this->params[$name]) || $this->params[$name] != $value)) {
//                        return false;
//                    }
//                }
//            }
//
//            return true;
//        }
//
//        return false;
//    }
}
