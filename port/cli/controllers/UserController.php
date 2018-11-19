<?php
namespace app\common\port\cli\controllers;

use app\common\console\Controller;
use app\modules\security\application\UserServiceInterface;
use app\modules\security\models\form\User;

/**
 * Class UserController
 * 
 *
 * @author Dzhamal Tayibov
 */
class UserController extends Controller
{
    private $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @todo реализовать на случай, если забыли пароль от пользователя, даже от суперпользователя
     */
    public function actionChangePassword()
    {

    }
}
