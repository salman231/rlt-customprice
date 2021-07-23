<?php
/**
 * SpecialPriceInterface
 *
 * @copyright Copyright © 2021 RLT. All rights reserved.
 */

namespace RLT\CustomPrice\Api\Data;

/**
 * Interface SpecialPriceInterface
 * @package RLT\CustomPrice\Api\Data
 */
interface SpecialPriceInterface
{
    /**#@+
     * All constants that exist in table as field
     */
    const ENTITY_ID = "row_id";
    const PRODUCT_ID = "product_id";
    const CUSTOMER_ID = "customer_id";
    const SPECIAL_PRICE = "special_price";
    const START_DATE = "start_date";
    const END_DATE = "end_date";
    /**#@-*/

    /**
     * Get special discount record
     * @return mixed
     */
    public function getId();

    /**
     * Set Row Id for entry
     * @param mixed $value
     * @return $this
     */
    public function setId($row_id);

    /**
     * Set special price for the entry
     * @param float $price
     * @return $this
     */
    public function setSpecialPrice($price);

    /**
     * Get special price value of record
     * @return float
     */
    public function getSpecialPrice();

    /**
     * @param string $startDate
     * @return SpecialPriceInterface
     */
    public function setStartDate($startDate);

    /**
     * Get start date of special discount
     * @return string|null
     */
    public function getStartDate();

    /**
     * @param string $endDate
     * @return SpecialPriceInterface
     */
    public function setEndDate($endDate);

    /**
     * Get end date of the special discount
     * @return string|null
     */
    public function getEndDate();

    /**
     * Set customer id for the entry
     * @param int|string $customerId
     * @return $this
     */
    public function setCustomerId($customerId);

    /**
     * Get customer id for which special discount is present
     * @return string
     */
    public function getCustomerId();

    /**
     * Set Product id for entry
     * @param int|string $productId
     * @return $this
     */
    public function setProductId($productId);

    /**
     * Get product id for which special discount is present
     * @return string
     */
    public function getProductId();
}

