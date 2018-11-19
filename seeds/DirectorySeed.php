<?php
namespace app\common\seeds;

/**
 * Class DirectorySeed
 *
 * @package app\common\seeds
 *
 *
 */
class DirectorySeed extends Seed
{
	/**
	 * @var bool
	 */
	public $useSimpleIdSequence = true;


	/**
	 * @return int
	 */
	protected function getDefaultUnionId()
	{
		return 1; // открытый контур
	}
}
