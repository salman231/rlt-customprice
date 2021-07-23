<?php
/**
 * SaveButton - UI Save button
 *
 * @copyright Copyright © 2021 RLT. All rights reserved.
 */

namespace RLT\CustomPrice\UI\Button;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class SaveButton
 * @package RLT\CustomPrice\UI\Button
 */
class SaveButton implements ButtonProviderInterface
{
    /**
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Save'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => ['button' => ['event' => 'save']],
                'form-role' => 'save',
            ],
            'sort_order'  =>  110,
        ];
    }
}
