<?php
namespace app\common\acl;

use app\common\acl\resource\ResourceInterface;
use app\common\helpers\ClassHelper;
use app\common\service\exception\AccessApplicationServiceException;
use app\modules\security\models\orm\User;

/**
 * Trait ApplicationResourceTrait
 * @package app\common\acl
 *
 * @author Dzhamal Tayibov
 */
trait ApplicationResourceTrait
{
    private $_proprietary;

    /**
     * @inheritdoc
     */
    public function setProprietary($obj)
    {
        $this->_proprietary = $obj;
    }

    /**
     * @inhe
     */
    public function getProprietary()
    {
        return $this->_proprietary;
    }

    /**
     * @param string $privilege
     * @param array $_
     * @return bool
     * @throws AccessApplicationServiceException
     * @throws \app\common\db\Exception
     */
    public function isAllowed($privilege, $proprietary = null)
    {
        if (\Yii::$app->user->isGuest) {
            throw new AccessApplicationServiceException('Требуется аутентификация.');
        }
        $user = User::findOneEx(\Yii::$app->user->id);
        $role = $user->aclRole;
        if (null === $role) {
            throw new AccessApplicationServiceException('У пользователя не найдена роль.');
        }
        if (!$this instanceof ResourceInterface) {
            throw new AccessApplicationServiceException('Текущий объект не является ресурсом ACL.');
        }
        /** @var Acl $acl */
        $acl = \Yii::$app->acl;
        if (!$acl->hasResource($this) || !$acl->hasRole($role)) {
            return false;
        }
        if (isset($proprietary)) {
            $this->_proprietary = $proprietary;
        }
        // todo proxy на новый объект, чтоб не ломать singleton текущий
        $check = $acl->isAllowed($role, $this, (string)$privilege);
        $this->_proprietary = null;
        return $check;
    }

    /**
     * @inheritdoc
     */
    public function getResourceId()
    {
        return static::class; // with NS = 99.999...% unique on project
    }

    /**
     * @inheritdoc
     */
    public function aclAlias()
    {
        return ClassHelper::getShortName(static::class);
    }

    /**
     * @inheritdoc
     */
    public function getPrivileges()
    {
        return [];
    }
}
