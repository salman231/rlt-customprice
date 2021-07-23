<?php
/**
 * SpecialPriceSearchResultInterface
 *
 * @copyright Copyright © 2021 RLT. All rights reserved.
 */

namespace RLT\CustomPrice\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface SpecialPriceSearchResultInterface
 * @package RLT\CustomPrice\Api\Data
 */
interface SpecialPriceSearchResultInterface extends SearchResultsInterface
{
    /**
     * Get special prices records.
     *
     * @return SpecialPriceInterface[]
     */
    public function getItems();

    /**
     * Set special prices records.
     *
     * @param SpecialPriceInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

