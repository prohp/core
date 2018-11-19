<?php
namespace app\common\notification\models;

use app\common\db\ActiveRecord;

/**
 * Class Notification
 * @package app\common\notification\models
 * @property int $type
 * @property int $status
 * @property string $message
 * @property string $to
 *
 * @author Dzhamal Tayibov
 */
class Notification extends ActiveRecord
{
    const TYPE_MAIL = 1;
    const TYPE_SKYPE = 2;
    const TYPE_WEBPUSH = 3;

    const STATUS_SENT = 1;
    const STATUS_NOT_SENT = 2;

    /**
     * @return array
     */
    public static function statuses()
    {
        return [
            self::STATUS_SENT => 'Отправлено',
            self::STATUS_NOT_SENT => 'Не отправлено',
        ];
    }

    /**
     * @return array
     */
    public static function types()
    {
        return [
            self::TYPE_MAIL => 'Mail',
            self::TYPE_SKYPE => 'Viber',
            self::TYPE_WEBPUSH => 'Webpush',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [ ['type', 'status'], 'integer', ],
            [ ['message', 'to', 'skype_service_url' ], 'string', ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabelsOverride()
    {
        return [
        ];
    }
}
