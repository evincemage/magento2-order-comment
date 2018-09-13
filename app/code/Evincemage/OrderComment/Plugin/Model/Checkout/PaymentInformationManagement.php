<?php

/**
 * @copyright Copyright (c) 2018 www.evincemage.com
 */

namespace Evincemage\OrderComment\Plugin\Model\Checkout;

class PaymentInformationManagement {

    protected $_quoteRepository;

    /**
     * @var \Magento\Framework\Json\Helper\Data
     */
    protected $_jsonHelper;

    /**
     * @var \Magento\Framework\Filter\FilterManager
     */
    protected $_filterManager;

    public function __construct(
    \Magento\Framework\Json\Helper\Data $jsonHelper, \Magento\Framework\Filter\FilterManager $filterManager, \Magento\Quote\Model\QuoteRepository $quoteRepository
    ) {
        $this->_jsonHelper = $jsonHelper;
        $this->_filterManager = $filterManager;
        $this->_quoteRepository = $quoteRepository;
    }

    public function beforeSavePaymentInformation(
    \Magento\Checkout\Model\PaymentInformationManagement $subject, $cartId, \Magento\Quote\Api\Data\PaymentInterface $paymentMethod
    ) {
        $orderComment = $paymentMethod->getExtensionAttributes();
        if ($orderComment->getComment())
            $comment = trim($orderComment->getComment());
        else
            $comment = '';
        $quote = $this->_quoteRepository->getActive($cartId);
        $quote->setEmOrderComment($comment);
       
    }

}
