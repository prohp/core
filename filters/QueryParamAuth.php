<?php
namespace app\common\filters;

class QueryParamAuth extends \yii\filters\auth\QueryParamAuth
{
    /**
     * @var bool
     */
    public $isSession = true;

    /**
     * {@inheritdoc}
     */
    public function authenticate($user, $request, $response)
    {
        $accessToken = $request->get($this->tokenParam);
        if (is_string($accessToken)) {
            if (!$this->isSession) {
                \Yii::$app->user->enableSession = false; // выключаем сессию и csrf для restful
                \Yii::$app->request->enableCsrfCookie = false;
                \Yii::$app->request->enableCsrfValidation = false;
            }
            $identity = $user->loginByAccessToken($accessToken, get_class($this));
            if ($identity !== null) {
                return $identity;
            }
        }
        if ($accessToken !== null) {
            $this->handleFailure($response);
        }

        return null;
    }
}
