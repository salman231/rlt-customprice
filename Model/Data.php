<?php
/**
 * Data Model for URL's
 *
 * @copyright Copyright © 2021 RLT. All rights reserved.
 */

namespace RLT\CustomPrice\Model;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\UrlInterface;

/**
 * Class Data
 * @package RLT\CustomPrice\Model
 */
class Data
{
    /**
     * Url Builder
     *
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * @var RequestInterface
     */
    protected $_request;

    /**
     * Constructor
     *
     * @param Context $context
     * @param RequestInterface $_request
     */
    public function __construct(
        Context $context,
        RequestInterface $_request
    ) {
        $this->urlBuilder = $context->getUrlBuilder();
        $this->_request = $_request;
    }

    /**
     * Generate url by route and parameters
     *
     * @param string $route
     * @param array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->urlBuilder->getUrl($route, $params);
    }

    /**
     * Get Row Id value form request object
     *
     * @return string
     */
    public function getRowId()
    {
        return $this->_request->getParam('row_id');
    }
}

