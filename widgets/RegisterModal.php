<?php
namespace app\common\widgets;

use app\common\base\UniqueKey;
use app\common\helpers\Html;
use app\common\web\View;

/**
 * Class ConfirmModal
 *
 *
 * @author Dzhamal Tayibov
 */
class RegisterModal extends Modal
{
    /**
     * @var string
     */
    public $content;
    /**
     * @var string
     */
    public $size = self::SIZE_SMALL;
    /**
     * @var array
     */
    public static $methodStack = [];


    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->header = 'Подтверждение действия';
        $this->footer = Html::button('Да', [
                'class' => 'btn btn-primary',
                'id' => 'confirm-ok',
                'icon' => 'glyphicon glyphicon-ok',
            ])
            . '&nbsp'
            . Html::button('Нет', [
                'class' => 'btn btn-danger',
                'id' => 'confirm-cancel',
                'icon' => 'glyphicon glyphicon-remove',
            ]);
        Html::addCssClass($this->options, 'b-confirm-modal');
        $this->options['data-backdrop'] = 'static';
        $this->options['data-keyboard'] = 'false';
        Html::addCssClass($this->headerOptions, 'b-header-modal');
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        if (isset($this->content) && gettype($this->content) === 'string') {
            echo Html::beginTag('span', [
                'style' => 'font-weight: 600; font-size: 15px;',
            ]);
            echo $this->content;
            echo Html::endTag('span');
        } elseif (isset($this->content) && gettype($this->content) === 'object') {
            // TODO!
        }
        parent::run();
    }

    /**
     * @param $event
     */
    public static function createModal($event)
    {
        echo static::widget([
            'id' => $event->data['id'],
            'content' => $event->data['message'],
        ]);
    }

    /**
     * Регистрируем модальное окно
     * @param int $id
     * @param string $message
     */
    public static function registerModal($id, $message)
    {
        \Yii::$app->view->on(View::EVENT_END_BODY, ['app\common\widgets\RegisterModal', 'createModal'], ['id' => $id, 'message' => $message]);
    }

    /**
     * Навешивать СТРОГО(!) через DOM onclick
     * @param string $methodName
     * @param string $message
     * @return string
     */
    public static function createMethod($methodName, $message)
    {
        $methodName = UniqueKey::generate($methodName, '');
        if (isset(static::$methodStack[$methodName])) { // todo ajax
            return $methodName . '(event)';
        }
        static::$methodStack[$methodName] = $methodName;
        $id = UniqueKey::generateByClass(static::className());
        $js = <<<JS
function {$methodName}(event) { // not expression
    if (event instanceof jQuery.Event) {
        return false;
    }
    event.preventDefault();
    event.stopImmediatePropagation();
    var target = $(event.target);
    $('#$id').modal('show');
    $('#$id #confirm-ok').one('click', function () { // todo dynamic #confirm-ok и тд
        target.trigger(event.type); // todo можно слать диспатчем и передавать просто доп. параметр на проверку вместо jQuery.Event
        $('#$id').modal('hide');
    });

    $('#$id #confirm-cancel').one('click', function () {
        $('#$id').modal('hide');
        $('#$id #confirm-ok').off('click');
    });
    
    return false;
}
JS;
        \Yii::$app->view->registerJs($js, View::POS_END);
        static::registerModal($id, $message);

        return $methodName . '(event)';
    }
}
