<?php
/**
 * DataProvider
 *
 * @copyright Copyright © 2021 RLT. All rights reserved.
 */

namespace RLT\CustomPrice\Model;

use Magento\Framework\App\RequestInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;
use RLT\CustomPrice\Model\ResourceModel\SpecialPrice\CollectionFactory as SpecialPriceCollectionFactory;

/**
 * Class DataProvider
 * @package RLT\CustomPrice\Model
 */
class DataProvider extends AbstractDataProvider
{
    /**
     * @var array
     */
    protected $loadedData;

    /**
     * @var RequestInterface
     */
    protected $_request;

    /**
     * DataProvider constructor.
     * @param $name
     * @param $primaryFieldName
     * @param $requestFieldName
     * @param SpecialPriceCollectionFactory $collectionFactory
     * @param RequestInterface $_request
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        SpecialPriceCollectionFactory $collectionFactory,
        RequestInterface $_request,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        $this->_request = $_request;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $this->loadedData = [];
        $items = $this->collection->getItems();
        foreach ($items as $specialPrice) {
            $this->loadedData[$specialPrice->getId()] = $specialPrice->getData();
        }

        return $this->loadedData;
    }

    /**
     * TO disable customer_id and product_id dropdowns on edit action
     * @return array
     */
    public function getMeta()
    {
        $meta = parent::getMeta();
        $id = $this->_request->getParam("row_id");
        if ($id) {
            $meta['specialprice_fieldset']['children']['customer_id']['arguments']['data']['config']['disabled'] = 1;
            $meta['specialprice_fieldset']['children']['product_id']['arguments']['data']['config']['disabled'] = 1;
        } else {
            $meta['specialprice_fieldset']['children']['customer_id']['arguments']['data']['config']['disabled'] = 0;
            $meta['specialprice_fieldset']['children']['product_id']['arguments']['data']['config']['disabled'] = 0;
        }
        return $meta;
    }
}

