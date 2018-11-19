<?php
namespace app\common\wrappers;

/**
 * Class WrapperAbleTrait
 *
 *
 * 
 */
trait WrapperTrait
{
    /**
     * @var string
     */
    public $wrapperContent;


    /**
     * @return null|void
     */
    public function injectWrapperOptions()
    {
        if (!isset($this->wrapperOptions) || !is_array($this->wrapperOptions)) {
            return null;
        }
        foreach ($this->wrapperOptions as $key => $option) {
            !property_exists($this, $key) ?: $this->{$key} = $option;
        }
    }

    /**
     * @return string
     */
    public function renderContent()
    {
        if (isset($this->wrapperContent) && gettype($this->wrapperContent) === 'string') {
            return $this->wrapperContent;
        } elseif (isset($this->wrapperContent) && gettype($this->wrapperContent) === 'object') { // todo serialize object and etc
            // todo реализовать попозже
        }
    }
}
