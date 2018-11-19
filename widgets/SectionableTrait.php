<?php
namespace app\common\widgets;

/**
 * Trait SectionableTrait
 *
 * @package app\common\widgets
 */
trait SectionableTrait
{
	/**
	 * @var bool
	 */
	public $skipUnknownSection = false;

	/**
	 * @inheritdoc
	 */
	public function renderSection($name)
	{
		$name = trim($name, '{}');
		$method = 'render' . $name;

		if (strtolower($name) === 'section') {
			throw new \Exception('You can`t use `section` name for the section');
		}
		if (!method_exists($this, $method)) {
			if (!$this->skipUnknownSection) {
				throw new \Exception("Unknown section `$name`");
			}
			return false;
		}
		return $this->{$method}();
	}
}
