<?php
namespace app\common\db;

/**
 * Class ArrayFinder
 * @package app\common\db
 *
 * @author Dzhamal Tayibov
 */
class ArrayFinder extends BaseFinder
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function search(array $params = [])
    {
        $this->load($params);
        $this->setAttributes($params);

        return $this->provider();
    }
}
