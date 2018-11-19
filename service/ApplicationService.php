<?php
namespace app\common\service;

use app\common\acl\ApplicationResourceTrait;
use app\common\acl\resource\ApplicationResourceInterface;
use app\common\db\ActiveRecord;
use yii\base\BaseObject;

/**
 * Class Service
 * @package app\common\service
 *
 * @author Dzhamal Tayibov
 */
class ApplicationService extends BaseObject implements ApplicationServiceInterface, ApplicationResourceInterface
{
    use ApplicationResourceTrait;

    /**
     * @var ActiveRecord
     * @deprecated
     */
    public $modelClass;

//    /**
//     * @todo возможно в метод can[UseCaseMethod] вставлять privilege
//     * @deprecated
//     * @inheritdoc
//     */
//    public function __call($name, $params)
//    {
//        if (!method_exists($this, $name) || !$this instanceof ResourceInterface) {
//            return parent::__call($name, $params);
//        }
//        $method = new \ReflectionMethod($this, $name);
//        if ($method->isPrivate()) {
//            throw new ApplicationServiceException('Method ' . $name . ' is private.');
//        }
//        $canMethod = 'can' . ucfirst($name);
//        if (method_exists($this, $canMethod)) { // нашли метод can[UseCaseMethod]
//            $method = new \ReflectionMethod($this, $canMethod);
//            if ($method->isPrivate()) {
//                throw new ApplicationServiceException('Method canable is private.');
//            }
//            if (!call_user_func_array([$this, $canMethod], $params)) {
//                throw new AccessApplicationServiceException('Доступ запрещен.');
//            } else {
//                return call_user_func_array([$this, $name], $params);
//            }
//        } else { // не нашли метод can[UseCaseMethod], значит применяем по умолчанию $this->canable()
//            $p = $params;
//            array_unshift($p, $name);
//            if (!call_user_func_array([$this, 'canable'], $p)) {
//                throw new AccessApplicationServiceException('Доступ запрещен.');
//            }
//            return call_user_func_array([$this, $name], $params);
//        }
//    }
}
