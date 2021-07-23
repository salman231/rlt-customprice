<?php
/**
 * MassDelete - An admin controller for bulk delete records
 * @author Salman Hanif
 * @copyright Copyright © 2021 RLT. All rights reserved.
 */
namespace RLT\CustomPrice\Controller\Adminhtml\CustomPrice;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use RLT\CustomPrice\Api\SpecialPriceRepositoryInterface;
use RLT\CustomPrice\Model\ResourceModel\SpecialPrice\CollectionFactory;

/**
 * Class MassDelete
 * @package RLT\CustomPrice\Controller\Adminhtml\CustomPrice
 */
class MassDelete extends Action implements HttpPostActionInterface
{
    /**
     * @var CollectionFactory
     */
    private $specialPriceFactory;

    /**
     * @var SpecialPriceRepositoryInterface
     */
    private $specialRepository;

    /**
     * MassDelete constructor.
     * @param Context $context
     * @param CollectionFactory $specialPriceFactory
     * @param SpecialPriceRepositoryInterface $specialRepository
     */
    public function __construct(
        Context $context,
        CollectionFactory $specialPriceFactory,
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
            $ids = $this->getRequest()->getParam('selected');

            if (is_array($ids) && !empty($ids)) {
                foreach ($ids as $id) {
                    $record = $this->specialRepository->getById($id);
                    $this->specialRepository->delete($record);
                }
                $this->messageManager->addSuccessMessage(__(count($ids) . ' row/s deleted successfully.'));
            } elseif ($this->getRequest()->getParam('excluded') == "false") {
                $items = $this->specialPriceFactory->create()->getItems();
                foreach ($items as $item) {
                    $this->specialRepository->delete($item);
                }
                $this->messageManager->addSuccessMessage(__('All records are deleted.'));
            }
        } catch (Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }

        return $redirectFactory->setPath('*/*/index');
    }
}
