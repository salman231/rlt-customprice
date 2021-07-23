<?php
/**
 * SpecialPriceRepository
 *
 * @copyright Copyright © 2021 RLT. All rights reserved.
 */

namespace RLT\CustomPrice\Model;

use http\Exception;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;
use RLT\CustomPrice\Api\Data\SpecialPriceInterface;
use RLT\CustomPrice\Api\Data\SpecialPriceSearchResultInterface;
use RLT\CustomPrice\Api\Data\SpecialPriceSearchResultInterfaceFactory;
use RLT\CustomPrice\Api\SpecialPriceRepositoryInterface;
use RLT\CustomPrice\Model\ResourceModel\SpecialPrice\CollectionFactory;
use RLT\CustomPrice\Model\ResourceModel\SpecialPrice;
use RLT\CustomPrice\Model\SpecialPriceFactory;

/**
 * Class SpecialPriceRepository
 * @package RLT\CustomPrice\Model
 */
class SpecialPriceRepository implements SpecialPriceRepositoryInterface
{
    /**
     * @var SpecialPriceFactory
     */
    private $specialPriceFactory;

    /**
     * @var CollectionFactory
     */
    private $specialPriceCollectionFactory;

    /**
     * @var SpecialPriceSearchResultInterfaceFactory
     */
    private $specialPriceResultInterfaceFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @var SpecialPrice
     */
    private $resource;

    /**
     * @var TimezoneInterface
     */
    private $time;

    /**
     * @var SearchCriteriaBuilder
     */
    private
        $searchCriteriaBuilder;

    /**
     * SpecialPriceRepository constructor.
     * @param SpecialPriceFactory $specialPriceFactory
     * @param CollectionFactory $specialPriceCollectionFactory
     * @param SpecialPriceSearchResultInterfaceFactory $specialPriceResultInterfaceFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param SpecialPrice $resource
     * @param TimezoneInterface $time
     */
    public function __construct(
        SpecialPriceFactory $specialPriceFactory,
        CollectionFactory $specialPriceCollectionFactory,
        SpecialPriceSearchResultInterfaceFactory $specialPriceResultInterfaceFactory,
        CollectionProcessorInterface $collectionProcessor,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        SpecialPrice $resource,
        TimezoneInterface $time
    ) {
        $this->specialPriceFactory = $specialPriceFactory;
        $this->specialPriceCollectionFactory = $specialPriceCollectionFactory;
        $this->specialPriceResultInterfaceFactory = $specialPriceResultInterfaceFactory;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->collectionProcessor = $collectionProcessor;
        $this->resource = $resource;
        $this->time = $time;
    }

    /**
     * @param string $row_id
     * @return SpecialPriceInterface|void
     * @throws NoSuchEntityException
     */
    public function getById($row_id)
    {
        $specialPrice = $this->specialPriceFactory->create();
        $this->resource->load($specialPrice, $row_id);
        if (!$specialPrice->getId()) {
            throw new NoSuchEntityException(__(
                'Unable to find special price entity with ID "%1"',
                $row_id
            ));
        }
        return $specialPrice;
    }

    /**
     * @param SpecialPriceInterface $specialPrice
     * @return SpecialPriceInterface|void
     * @throws AlreadyExistsException
     */
    public function save(SpecialPriceInterface $specialPrice)
    {
        /** @var SpecialPriceInterface $specialPrice */
        $specialPrice = $this->resource->save($specialPrice);

        return $specialPrice;
    }

    /**
     * @param SpecialPriceInterface $specialPrice
     * @return void
     * @throws Exception
     */
    public function delete(SpecialPriceInterface $specialPrice)
    {
        $this->resource->delete($specialPrice);
    }

    /**
     * @param string $customerId
     * @param string $productId |null
     * @return SpecialPriceSearchResultInterface|void
     */
    public function getListByCustomer($customerId, $productId = null)
    {
        $this->searchCriteriaBuilder->addFilter(
            SpecialPriceInterface::CUSTOMER_ID,
            $customerId
        );

        $today = $this->time->date()->format('Y-m-d');

        $this->searchCriteriaBuilder->addFilter(
            SpecialPriceInterface::START_DATE,
            $today,
            'lteq'
        );

        $this->searchCriteriaBuilder->addFilter(
            SpecialPriceInterface::END_DATE,
            $today,
            'gteq'
        );

        if (!empty($productId)) {
            $this->searchCriteriaBuilder->addFilter(
                SpecialPriceInterface::PRODUCT_ID,
                $productId
            );
        }

        $searchCriteria = $this->searchCriteriaBuilder->create();
        $list = $this->getList($searchCriteria);
        return $list;
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return SpecialPriceSearchResultInterface|void
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $specialCollection = $this->specialPriceCollectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $specialCollection);
        $results = $this->specialPriceResultInterfaceFactory->create();

        $results->setSearchCriteria($searchCriteria);
        $results->setItems($specialCollection->getItems());

        return $results;
    }
}

