<?php
/**
 * ProductOptions - Loading All Product Options in UI
 *
 * @copyright Copyright © 2021 RLT. All rights reserved.
 */

namespace RLT\CustomPrice\UI\Select;
use Magento\Framework\Data\OptionSourceInterface;
/**
 * Class ProductOptions
 * @package RLT\CustomPrice\UI\Select
 */
class ProductOptions implements OptionSourceInterface
{
    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    private $_options;

    /**
     * @var \Magento\Catalog\Api\ProductRepositoryInterface
     */
    private $_productRepository;

    /**
     * @var \Magento\Framework\Api\SearchCriteriaBuilder
     */
    private $_searchCriteriaBuilder;

    /**
     * ProductOptions constructor.
     * @param \Magento\Catalog\Api\ProductRepositoryInterface $productRepository
     * @param \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->_productRepository = $productRepository;
        $this->_searchCriteriaBuilder = $searchCriteriaBuilder;
        if($this->_options == null){
            $this->_options = [];
        }
    }

    /**
     * @return array|\Magento\Framework\Controller\Result\JsonFactory
     */
    public function toOptionArray()
    {
        if(empty($this->_options)){
            $this->loadOptions();
        }

        return $this->_options;
    }

    /**
     * @inheritDoc
     */
    public function loadOptions(){

        $products = $this->_productRepository->getList($this->_searchCriteriaBuilder->create());

        $formattedArray = [];
        if($products->getTotalCount() > 0){
            foreach ($products->getItems() as $prod) {
                $formattedArray[] = [
                    'value' => $prod->getId(),
                    'label' => $prod->getName() . " (" . $prod->getSku() . ")"
                ];
            }
        }

        $this->_options = $formattedArray;
    }
}

