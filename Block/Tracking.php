<?php

namespace LCB\HomebookPixel\Block;

/**
 * Class Tracking
 *
 * @author Tomasz Gregorczyk <tomasz@silpion.com.pl>
 */
class Tracking extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magento\Checkout\Model\Session
     */
    protected $checkoutSession;

    /**
     * @var \Magento\Sales\Api\OrderRepositoryInterface
     */
    protected $orderRepository;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Checkout\Model\Session $checkoutSession
     * @param \Magento\Sales\Api\OrderRepositoryInterface $orderRepository
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Sales\Api\OrderRepositoryInterface $orderRepository
    ) {
        $this->checkoutSession = $checkoutSession;
        $this->orderRepository = $orderRepository;
        parent::__construct($context);
    }

    /**
     * Set purchase details
     */
    public function getOrder()
    {
        $lastOrderId = $this->checkoutSession->getLastOrderId();
        return $this->orderRepository->get($lastOrderId);
    }

    /**
     * @return bool
     */
    public function getIsCheckout()
    {
        return $this->getRequest()->getFullActionName() === 'checkout_onepage_success';
    }
}
