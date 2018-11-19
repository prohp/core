<?php
namespace app\common\port\cli\controllers;

use app\common\console\Controller;
use app\common\notification\models\Notification;
use app\common\notification\NotificationServiceInterface;

/**
 * Class SkypeBotController
 * 
 *
 * @author Dzhamal Tayibov
 */
class NotificationController extends Controller
{
    public $notificationService;

    public function __construct(
        $id,
        $module,
        NotificationServiceInterface $notificationService,
        array $config = []
    ) {
        $this->notificationService = $notificationService;
        parent::__construct($id, $module, $config);
    }

    public function actionAllExecute()
    {
        $this->notificationService->sendAll(Notification::TYPE_MAIL);
        $this->notificationService->sendAll(Notification::TYPE_SKYPE);
    }

    public function actionMailExecute()
    {

    }

    public function actionViberExecute()
    {

    }

    public function actionWebPushExecute()
    {

    }
}
