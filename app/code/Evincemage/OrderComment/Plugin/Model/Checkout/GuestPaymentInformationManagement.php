<?php
/**
 * @copyright Copyright (c) 2018 www.evincemage.com
 */

namespace Evincemage\OrderComment\Plugin\Model\Checkout;

class GuestPaymentInformationManagement
{

    protected $_quoteRepository;
    
    protected $quoteIdMaskFactory;

    /**
     * @var \Magento\Framework\Json\Helper\Data
     */
    protected $_jsonHelper;

    /**
     * @var \Magento\Framework\Filter\FilterManager
     */
    protected $_filterManager;

    /**
     * GuestPaymentInformationManagement constructor.
     *
     * @param \Magento\Sales\Model\Order\Status\HistoryFactory $historyFactory
     * @param \Magento\Sales\Model\OrderFactory $orderFactory
     */
    public function __construct(
    \Magento\Framework\Json\Helper\Data $jsonHelper, \Magento\Framework\Filter\FilterManager $filterManager, \Magento\Quote\Model\QuoteRepository $quoteRepository, \Magento\Quote\Model\QuoteIdMaskFactory $quoteIdMaskFactory
    ) {
        $this->_jsonHelper = $jsonHelper;
        $this->_filterManager = $filterManager;
        $this->_quoteRepository = $quoteRepository;
        $this->quoteIdMaskFactory = $quoteIdMaskFactory;
    }

    /**
     * @param \Magento\Checkout\Model\GuestPaymentInformationManagement $subject
     * @param \Closure $proceed
     * @param $cartId
     * @param $email
     * @param \Magento\Quote\Api\Data\PaymentInterface $paymentMethod
     * @param \Magento\Quote\Api\Data\AddressInterface|null $billingAddress
     * @return int $orderId
     */

    public function beforeSavePaymentInformation(
    \Magento\Checkout\Model\GuestPaymentInformationManagement $subject, $cartId, $email, \Magento\Quote\Api\Data\PaymentInterface $paymentMethod
    ) {
        $orderComment = $paymentMethod->getExtensionAttributes();
        if ($orderComment->getComment()):
            $comment = trim($orderComment->getComment());
            $orderComment = $this->_filterManager->stripTags($comment);
                $quoteIdMask = $this->quoteIdMaskFactory->create()->load($cartId, 'masked_id');
                $quote = $this->_quoteRepository->getActive($quoteIdMask->getQuoteId());
                $quote->setEmOrderComment($orderComment);
        
        endif;
       
    }

}
