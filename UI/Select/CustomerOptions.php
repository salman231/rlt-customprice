<?php
/**
 * CustomerOptions - Loading Customer Options in UI
 *
 * @copyright Copyright © 2021 RLT. All rights reserved.
 */

namespace RLT\CustomPrice\UI\Select;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class CustomerOptions
 * @package RLT\CustomPrice\UI\Select
 */
class CustomerOptions implements OptionSourceInterface
{
    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    private $_options;

    /**
     * @var \Magento\Customer\Api\CustomerRepositoryInterface
     */
    private $_customerRepository;

    /**
     * @var \Magento\Framework\Api\SearchCriteriaBuilder
     */
    private $_searchCriteriaBuilder;

    /**
     * CustomerOptions constructor.
     * @param CustomerRepositoryInterface $customerRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->_customerRepository = $customerRepository;
        $this->_searchCriteriaBuilder = $searchCriteriaBuilder;
        if($this->_options == null){
            $this->_options = [];
        }
    }

    /**
     * @return array|\Magento\Framework\Controller\Result\JsonFactory
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function toOptionArray()
    {
        if(empty($this->_options)){
            $this->loadOptions();
        }

        return $this->_options;
    }

    /**
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function loadOptions(){

        $customers = $this->_customerRepository->getList($this->_searchCriteriaBuilder->create());

        $formattedArray = [];
        if($customers->getTotalCount() > 0){
            foreach ($customers->getItems() as $customer) {
                $formattedArray[] = [
                    'value' => $customer->getId(),
                    'label' => $customer->getFirstname() . " " . $customer->getLastname()
                ];
            }
        }

        $this->_options = $formattedArray;
    }
}

