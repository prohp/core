<?php
namespace app\common\web;

use app\modules\security\models\orm\User as UserOrm;

/**
 * Class User
 * 
 *
 */
class User extends \yii\web\User
{
    /**
     * @var array
     */
    public $loginUrl = ['/security/ui/user/login-form'];

    public function isSuper()
    {
        $user = $this->identity;
        if (is_null($user) || !$user instanceof UserOrm) {
            // core зависит от модуля security
            return false;
        }
        $role = $user->aclRole->name;
        if ($role === getenv('SUPER_LOGIN')) {
            return true;
        }
        return false;
    }
}
