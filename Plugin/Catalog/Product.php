<?php
/**
 * Product
 *
 * @copyright Copyright © 2021 RLT. All rights reserved.
 */
namespace RLT\CustomPrice\Plugin\Catalog;

use Magento\Customer\Model\SessionFactory;
use RLT\CustomPrice\Api\SpecialPriceRepositoryInterface;

/**
 * Class Product
 * @package RLT\CustomPrice\Plugin\Catalog
 */
class Product
{
    /**
     * @var SessionFactory
     */
    private $sessionCustomer;

    /**
     * @var SpecialPriceRepositoryInterface
     */
    private $specialPriceRepository;

    /**
     * Product constructor.
     * @param SpecialPriceRepositoryInterface $specialPriceRepository
     * @param SessionFactory $sessionCustomer
     */
    public function __construct(
        SpecialPriceRepositoryInterface $specialPriceRepository,
        SessionFactory $sessionCustomer
    ) {
        $this->specialPriceRepository = $specialPriceRepository;
        $this->sessionCustomer = $sessionCustomer;
    }

    /**
     * @param \Magento\Catalog\Model\Product $product
     * @param $value
     * @return mixed
     */
    public function afterGetPrice(
        \Magento\Catalog\Model\Product $product,
        $value
    ) {
        $customerId = $this->sessionCustomer->create()->getId();

        if ($customerId) {
            $records = $this->specialPriceRepository->getListByCustomer($customerId, $product->getEntityId());
            $records = $records->getItems();
            if (count($records) > 0) {
                $specialRecord = end($records);
                $value = $specialRecord->getSpecialPrice();
            }
        }
        return $value;
    }
}

