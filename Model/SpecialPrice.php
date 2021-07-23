<?php
/**
 * SpecialPrice
 *
 * @copyright Copyright © 2021 RLT. All rights reserved.
 */

namespace RLT\CustomPrice\Model;

use Magento\Framework\Model\AbstractModel;
use RLT\CustomPrice\Api\Data\SpecialPriceInterface;

/**
 * Class SpecialPrice
 * @package RLT\CustomPrice\Model
 */
class SpecialPrice extends AbstractModel implements SpecialPriceInterface
{
    /**
     * @inheirtDoc
     */
    public function getId()
    {
        return $this->getData(self::ENTITY_ID);
    }

    /**
     * @inheirtDoc
     */
    public function setId($row_id)
    {
        $this->setData(self::ENTITY_ID, $row_id);
    }

    /**
     * @inheirtDoc
     */
    public function setSpecialPrice($price)
    {
        $this->setData(self::SPECIAL_PRICE, $price);
    }

    /**
     * @inheirtDoc
     */
    public function getSpecialPrice()
    {
        return $this->getData(self::SPECIAL_PRICE);
    }

    /**
     * @inheirtDoc
     */
    public function setStartDate($startDate)
    {
        $this->setData(self::START_DATE, $startDate);
    }

    /**
     * @inheirtDoc
     */
    public function getStartDate()
    {
        return $this->getData(self::START_DATE);
    }

    /**
     * @inheirtDoc
     */
    public function setEndDate($endDate)
    {
        $this->setData(self::END_DATE, $endDate);
    }

    /**
     * @inheirtDoc
     */
    public function getEndDate()
    {
        return $this->getData(self::END_DATE);
    }

    /**
     * @inheirtDoc
     */
    public function setCustomerId($customerId)
    {
        $this->setData(self::CUSTOMER_ID, $customerId);
    }

    /**
     * @inheirtDoc
     */
    public function getCustomerId()
    {
        return $this->getData(self::CUSTOMER_ID);
    }

    /**
     * @inheirtDoc
     */
    public function setProductId($productId)
    {
        $this->setData(self::PRODUCT_ID, $productId);
    }

    /**
     * @inheirtDoc
     */
    public function getProductId()
    {
        return $this->getData(self::PRODUCT_ID);
    }

    /**
     * Construct.
     * @return void
     */
    protected function _construct()
    {
        $this->_init('RLT\CustomPrice\Model\ResourceModel\SpecialPrice');
    }
}

