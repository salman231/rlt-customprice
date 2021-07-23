<?php
/**
 * SpecialPrice
 *
 * @copyright Copyright © 2021 RLT. All rights reserved.
 */

namespace RLT\CustomPrice\Model\ResourceModel;

/**
 * Class SpecialPrice
 * @package RLT\CustomPrice\Model\ResourceModel
 */
class SpecialPrice extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Table name constant initialized
     */
    const TABLE_NAME = 'rlt_customer_prices';

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(static::TABLE_NAME, 'row_id');
    }
}

