<?php

declare(strict_types=1);

/**
 * File: Inlinesave.php
 * @author Szymon Borowski <szymon.borowski@gmail.com>
 * @copyright 2024 Szymon Borowski <szymon.borowski@gmail.com>
 */

namespace Szymonborowski\Checkout\Controller\Adminhtml\Grid;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Exception\InvalidArgumentException;
use Magento\Framework\Exception\NoSuchEntityException;
use Szymonborowski\Checkout\Service\OrderTypeOptionsRepository;

/**
 * class Inlinesave
 * @package Szymonborowski\Checkout\Controller\Adminhtml\Grid
 */
class Inlinesave extends Action implements HttpPostActionInterface
{
    public function __construct(
        private readonly OrderTypeOptionsRepository $orderTypeOptionsRepository,
        private readonly JsonFactory $jsonFactory,
        Context $context
    ) {
        parent::__construct($context);
    }

    public function execute(): Json
    {
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];

        try {
            $orderTypeOptionList = $this->getRequest()->getParam('items');

            foreach ($orderTypeOptionList as $orderTypeOptionData) {
                $orderTypeOption = $this->orderTypeOptionsRepository->getById((int)$orderTypeOptionData['id']);

                if (empty($orderTypeOptionData['label'])) {
                    throw new InvalidArgumentException(__('Label field is required'));
                }

                $orderTypeOption->setLabel($orderTypeOptionData['label']);
                $this->orderTypeOptionsRepository->save($orderTypeOption);
            }
        } catch (NoSuchEntityException|InvalidArgumentException $e) {
            $messages[] = "[Error:] {$e->getMessage()}";
            $error = true;
        } catch (Exception $e) {
            $messages[] = "[Error:] Critical error occurred. Operation failed.";
            $error = true;
        }

        return $resultJson->setData(
            [
                'messages' => $messages,
                'error' => $error
            ]
        );
    }
}
