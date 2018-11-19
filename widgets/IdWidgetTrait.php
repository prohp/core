<?php
namespace app\common\widgets;

use app\common\base\UniqueKey;

/**
 * Class IdWidgetTrait
 * @package app\common\widgets
 *
 * @author Dzhamal Tayibov
 */
trait IdWidgetTrait
{
    /**
     * @param bool $autoGenerate
     *
     * @return mixed|null
     */
    public function getId($autoGenerate = true)
    {
        if (isset($this->options['id']) && !empty($this->options['id'])) {
            return $this->options['id'];
        } elseif ($autoGenerate) {
            return $this->options['id'] = UniqueKey::generateByClass($this);
        } else {
            return null;
        }
    }

    /**
     * @param string|int $id
     */
    public function setId($id)
    {
        $this->options['id'] = $id;
    }
}
