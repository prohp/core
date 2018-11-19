<?php

/**
 * @var string $namespace
 * @var string $className
 */

echo '<' . '?php';
?>

namespace <?php echo $namespace; ?>;

use app\common\seeds\Seed;

class <?php echo $className; ?> extends Seed
{
	public function run()
	{
		//
	}
}
