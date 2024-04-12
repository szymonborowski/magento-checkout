<?php

declare(strict_types=1);

/**
 * File: Save.php
 * @author Szymon Borowski <szymon.borowski@gmail.com>
 * @copyright 2024 Szymon Borowski <szymon.borowski@gmail.com>
 */

namespace Szymonborowski\Checkout\Controller\Adminhtml\Grid;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Exception\InvalidArgumentException;
use Magento\Framework\Exception\NoSuchEntityException;
use Szymonborowski\Checkout\Api\Data\OrderTypeOptionsInterfaceFactory;
use Szymonborowski\Checkout\Service\OrderTypeOptionsRepository;

/**
 * class Save
 * @package Szymonborowski\Checkout\Controller\Adminhtml\Grid
 */
class Save extends Action implements HttpPostActionInterface
{
    public function __construct(
        private readonly OrderTypeOptionsInterfaceFactory $orderTypeOptionsInterfaceFactory,
        private readonly OrderTypeOptionsRepository $orderTypeOptionsRepository,
        Context $context
    ) {
        parent::__construct($context);
    }

    public function execute(): ResponseInterface
    {
        try {
            $orderTypeOptionId = $this->getRequest()->getParam('id');

            if ($orderTypeOptionId) {
                $orderTypeOption = $this->orderTypeOptionsRepository->getById($orderTypeOptionId);
            } else {
                $orderTypeOption = $this->orderTypeOptionsInterfaceFactory->create();
            }

            $orderTypeOptionLabel = $this->getRequest()->getParam('label');

            if (empty($orderTypeOptionLabel)) {
                throw new InvalidArgumentException(__('Label field is required'));
            }

            $orderTypeOption->setLabel($orderTypeOptionLabel);
            $this->orderTypeOptionsRepository->save($orderTypeOption);
        } catch (NoSuchEntityException|InvalidArgumentException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (Exception $e) {
            $this->messageManager->addErrorMessage(__('Critical error occurred. Operation failed.'));
        }

        $this->_redirect('*/*/index');

        return $this->getResponse();
    }
}
