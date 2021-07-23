<?php
/**
 * Save - An admin controller to save data to database
 * @author Salman Hanif
 * @copyright Copyright © 2021 RLT. All rights reserved.
 */
namespace RLT\CustomPrice\Controller\Adminhtml\CustomPrice;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use RLT\CustomPrice\Api\Data\SpecialPriceInterfaceFactory;
use RLT\CustomPrice\Api\SpecialPriceRepositoryInterface;
use RLT\CustomPrice\Model\SpecialPriceRepository;

/**
 * Class Save
 * @package RLT\CustomPrice\Controller\Adminhtml\CustomPrice
 */
class Save extends Action implements HttpPostActionInterface
{
    /**
     * @var SpecialPriceInterfaceFactory
     */
    private $specialPriceFactory;
    /**
     * @var SpecialPriceRepositoryInterface
     */
    private $specialRepository;
    /**
     * Save constructor.
     * @param Context $context
     * @param SpecialPriceInterfaceFactory $specialPriceFactory
     * @param SpecialPriceRepositoryInterface $specialRepository
     */
    public function __construct(
        Context $context,
        SpecialPriceInterfaceFactory $specialPriceFactory,
        SpecialPriceRepositoryInterface $specialRepository
    ) {
        parent::__construct($context);
        $this->specialPriceFactory = $specialPriceFactory;
        $this->specialRepository = $specialRepository;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     *
     */
    public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->renderLayout();
        $redirectFactory = $this->resultRedirectFactory->create();

        $data = $this->getRequest()->getPostValue();
        if (is_array($data) && isset($data["row_id"]) && !empty($data["row_id"])) {
            try {
                $record = $this->specialRepository->getById($data["row_id"]);
            } catch (NoSuchEntityException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $redirectFactory->setPath('*/*/index');
            }
            $record->setData($data);
            $record->setId($data["row_id"]);
        } else {
            $record = $this->specialPriceFactory->create();
            /**
             * check if a customer is already assigned a special price for already added product
             */
            $customerData = $this->specialRepository->getListByCustomer($data['customer_id']);
            $customerDataArray = $customerData->getItems();
            if(!empty($customerDataArray) && is_array($customerDataArray)) {
                foreach ($customerDataArray as $item) {
                    $specifiedCustomerData = $item->getData();
                    if ($specifiedCustomerData['customer_id'] == $data['customer_id'] && $specifiedCustomerData['product_id'] == $data['product_id']) {
                        $this->messageManager->addErrorMessage('This product has been already assigned to your specified customer. Click on Edit below to change price or date');
                        return $redirectFactory->setPath('*/*/index');
                    }
                }
                $record->setData($data);
            }else{
                $record->setData($data);
            }
        }

        try {
            $this->specialRepository->save($record);
            $this->messageManager->addSuccessMessage(__('Customer Special Price has been applied to customer.'));

            return $redirectFactory->setPath("*/*/index");
        } catch (Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }
        return $redirectFactory->setPath('*/*/index');
    }
}
