<?php
/**
 * Actions
 *
 * @copyright Copyright © 2021 RLT. All rights reserved.
 */

namespace RLT\CustomPrice\UI\Listing;
use Magento\Ui\Component\Listing\Columns\Column;
/**
 * Class Actions
 * @package RLT\CustomPrice\UI\Listing
 */
class Actions extends Column
{
    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $item[$this->getData('name')] = [
                    'edit' => [
                        'href' => '/specialprice/customprice/add',
                        'label' => __('Edit')
                    ]
                ];
            }
        }
        return $dataSource;
    }
}

