<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace V4U\Emailvariable\Observer\Email;

use Magento\Customer\Api\CustomerRepositoryInterface;

class OrderSetTemplateVarsBefore implements \Magento\Framework\Event\ObserverInterface
{

    protected $customerRepository;

    public function __construct(
        CustomerRepositoryInterface $customerRepository
    ) {
        $this->customerRepository = $customerRepository;
    }

    /**
     * Execute observer
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(
        \Magento\Framework\Event\Observer $observer
    ) {
        
        /** @var \Magento\Framework\App\Action\Action $controller */
        $transport = $observer->getEvent()->getTransport();
        if($transport->getOrder() != null)
        {
            $customer = $this->customerRepository->getById($transport->getOrder()->getCustomerId());
            $transport['userId'] = $customer->getId();
        }
    }
}