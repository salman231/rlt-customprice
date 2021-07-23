<?php
/**
 * Collection
 *
 * @copyright Copyright © 2021 RLT. All rights reserved.
 */

namespace RLT\CustomPrice\Model\ResourceModel\SpecialPrice;

/**
 * Class Collection
 * @package RLT\CustomPrice\Model\ResourceModel\SpecialPrice
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('RLT\CustomPrice\Model\SpecialPrice', 'RLT\CustomPrice\Model\ResourceModel\SpecialPrice');
    }
}
