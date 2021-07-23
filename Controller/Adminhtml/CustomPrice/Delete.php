<?php
/**
 * Delete - An admin controller to delete records
 * @author Salman Hanif
 * @copyright Copyright © 2021 RLT. All rights reserved.
 */
namespace RLT\CustomPrice\Controller\Adminhtml\CustomPrice;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use RLT\CustomPrice\Api\Data\SpecialPriceInterfaceFactory;
use RLT\CustomPrice\Api\SpecialPriceRepositoryInterface;

/**
 * Class Delete
 * @package RLT\CustomPrice\Controller\Adminhtml\CustomPrice
 */
class Delete extends Action implements HttpGetActionInterface
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
     * Delete constructor.
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
     */
    public function execute()
    {
        try {
            $this->_view->loadLayout();
            $this->_view->renderLayout();
            $redirectFactory = $this->resultRedirectFactory->create();
            $id = $this->getRequest()->getParam('id');

            if (isset($id) && !empty($id)) {
                $record = $this->specialRepository->getById($id);
                $this->specialRepository->delete($record);
                $this->messageManager->addSuccessMessage(__('Data has been deleted successfully.'));
            } else {
                $this->messageManager->addSuccessMessage(__('Row Id not found'));
            }
        } catch (Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }

        return $redirectFactory->setPath('*/*/index');
    }
}
