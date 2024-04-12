<?php

declare(strict_types=1);

/**
 * File: Delete.php
 * @author Szymon Borowski <szymon.borowski@gmail.com>
 * @copyright 2024 Szymon Borowski <szymon.borowski@gmail.com>
 */

namespace Szymonborowski\Checkout\Controller\Adminhtml\Grid;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Szymonborowski\Checkout\Service\OrderTypeOptionsRepository;

/**
 * class Delete
 * @package Szymonborowski\Checkout\Controller\Adminhtml\Grid
 */
class Delete extends Action implements HttpGetActionInterface
{
    public function __construct(
        private readonly OrderTypeOptionsRepository $orderTypeOptionsRepository,
        Context $context
    ) {
        parent::__construct($context);
    }

    public function execute(): ResponseInterface
    {
        $orderTypeOptionId = (int)$this->getRequest()->getParam('id');

        try {
            $orderTypeOption = $this->orderTypeOptionsRepository->getById($orderTypeOptionId);
            $this->orderTypeOptionsRepository->delete($orderTypeOption);
        } catch (NoSuchEntityException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (Exception|CouldNotDeleteException $e) {
            $this->messageManager->addErrorMessage(__('Critical error occurred. Operation failed.'));
        }

        $this->_redirect('*/*/index');

        return $this->getResponse();
    }
}
