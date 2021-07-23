<?php
/**
 * Price - Frontend Controller getting special price on ajax
 *
 * @copyright Copyright © 2021 RLT. All rights reserved.
 */

namespace RLT\CustomPrice\Controller\Product;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Customer\Model\SessionFactory;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use RLT\CustomPrice\Api\SpecialPriceRepositoryInterface;

/**
 * Class Price
 * @package RLT\CustomPrice\Controller\Product
 */
class Price implements HttpPostActionInterface
{
    /**
     * @var JsonFactory
     */
    private $resultJsonFactory;

    /**
     * @var SpecialPriceRepositoryInterface
     */
    private $specialPriceRepository;

    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * @var SessionFactory
     */
    private $sessionCustomer;

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * Price constructor.
     * @param JsonFactory $resultJsonFactory
     * @param Context $context
     * @param SpecialPriceRepositoryInterface $specialPriceRepository
     * @param ProductRepositoryInterface $productRepository
     * @param SessionFactory $sessionCustomer
     * @param RequestInterface $request
     */
    public function __construct(
        JsonFactory $resultJsonFactory,
        Context $context,
        SpecialPriceRepositoryInterface $specialPriceRepository,
        ProductRepositoryInterface $productRepository,
        SessionFactory $sessionCustomer,
        RequestInterface $request
    ) {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->specialPriceRepository = $specialPriceRepository;
        $this->sessionCustomer = $sessionCustomer;
        $this->productRepository = $productRepository;
        $this->request = $request;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Json|\Magento\Framework\Controller\ResultInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function execute()
    {
        $resultJson = $this->resultJsonFactory->create();

        $productId = $this->request->getPostValue("product_id");

        if (!$productId) {
            return $resultJson->setData(["status" => "error", "msg" => "Product id is required."]);
        }

        $customerId = $this->sessionCustomer->create()->getId();

        if (!$customerId) {
            return $resultJson->setData([
                "status" => "error",
                "product_id" => $productId,
                "notloggedIn" => true,
                "msg" => "Customer not logged in"
            ]);
        }

        $data = $this->specialPriceRepository->getListByCustomer($customerId, $productId);
        $data = $data->getItems();

        if (count($data) > 0) {
            $specialDiscount = end($data);

            $formattedResp = [
                "product_id" => $specialDiscount->getProductId(),
                "price" => $specialDiscount->getSpecialPrice(),
                'label_bool' => true
            ];
        } else {
            $product = $this->productRepository->getById($productId);

            $formattedResp = [
                "product_id" => $productId,
                "price" => $product->getPrice()
            ];
        }

        return $resultJson->setData($formattedResp);
    }
}
