<?php
/**
 * BackButton - UI Back Button
 *
 * @copyright Copyright © 2021 RLT. All rights reserved.
 */
namespace RLT\CustomPrice\UI\Button;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use RLT\CustomPrice\Model\Data;

/**
 * Class BackButton
 * @package RLT\CustomPrice\UI\Button
 */
class BackButton implements ButtonProviderInterface
{
    /**
     * @var Data
     */
    private $data;

    /**
     * BackButton constructor.
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
        return [
            'label' => __('Back'),
            'on_click' => sprintf("location.href = '%s';", $this->getBackUrl()),
            'class' => 'back',
            'sort_order' => 10
        ];
    }

    /**
     * @return string
     */
    public function getBackUrl()
    {
        return $this->data->getUrl('specialprice/customprice/index');
    }
}

