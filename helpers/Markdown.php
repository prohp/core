<?php
namespace app\common\helpers;

class Markdown extends \yii\helpers\Markdown
{
    /**
     * @var array a map of markdown flavor names to corresponding parser class configurations.
     */
    public static $flavors = [
        'signal' => [
            'class' => 'app\common\markdown\SignalMarkdown',
            'html5' => true,
        ],
    ];

    /**
     * @var string the markdown flavor to use when none is specified explicitly.
     * Defaults to `original`.
     * @see $flavors
     */
    public static $defaultFlavor = 'signal';

    /**
     * Converts markdown into HTML.
     *
     * @param string $markdown the markdown text to parse
     * @param string $flavor the markdown flavor to use. See [[$flavors]] for available values.
     * Defaults to [[$defaultFlavor]], if not set.
     * @return string the parsed HTML output
     * @throws \yii\base\InvalidParamException when an undefined flavor is given.
     */
    public static function process($markdown, $flavor = null)
    {
        return static::additionalParse(parent::process($markdown, $flavor = null));
    }

    public function additionalParse($content)
    {
        return $content;
    }
}