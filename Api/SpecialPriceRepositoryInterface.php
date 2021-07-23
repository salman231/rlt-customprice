<?php
/**
 * SpecialPriceRepositoryInterface
 *
 * @copyright Copyright © 2021 RLT. All rights reserved.
 */

namespace RLT\CustomPrice\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use RLT\CustomPrice\Api\Data\SpecialPriceInterface;
use RLT\CustomPrice\Api\Data\SpecialPriceSearchResultInterface;

/**
 * Interface SpecialPriceRepositoryInterface
 * @package RLT\CustomPrice\Api
 */
interface SpecialPriceRepositoryInterface
{
    /**
     * Retrieve SpecialPrice record.
     *
     * @param string $row_id
     * @return SpecialPriceInterface
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function getById($row_id);

    /**
     * Retrieve SpecialPrice entries that match the provided criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return SpecialPriceSearchResultInterface
     * @throws LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * Save SpecialPrice record.
     *
     * @param SpecialPriceInterface $specialPrice
     * @return SpecialPriceInterface
     * @throws LocalizedException
     */
    public function save(SpecialPriceInterface $specialPrice);

    /**
     * Delete SpecialPrice record.
     *
     * @param SpecialPriceInterface $specialPrice
     * @return void
     * @throws LocalizedException
     */
    public function delete(SpecialPriceInterface $specialPrice);
}

