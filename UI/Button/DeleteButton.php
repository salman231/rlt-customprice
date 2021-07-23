<?php
/**
 * DeleteButton - Delete Button UI
 *
 * @copyright Copyright © 2021 RLT. All rights reserved.
 */
namespace RLT\CustomPrice\UI\Button;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use RLT\CustomPrice\Model\Data;

/**SS
 * Class DeleteButton
 * @package RLT\CustomPrice\UI\Button
 */
class DeleteButton implements ButtonProviderInterface
{
    /**
     * @var Data
     */
    private $data;

    /**
     * DeleteButton constructor.
     * @param Data $data
     */
    public function __construct(
        Data $data
    ) {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getButtonData()
    {
        if ($this->data->getRowId()) {
            return [
                'label' => __('Delete'),
                'on_click' => sprintf("location.href = '%s';", $this->getDeleteUrl()),
                'class' => 'delete',
                'sort_order' => 10
            ];
        } else {
            return [];
        }
    }

    /**
     * @return string
     */
    public function getDeleteUrl()
    {
        return $this->data->getUrl('specialprice/customprice/delete', ['id' => $this->data->getRowId()]);
    }
}
