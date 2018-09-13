<?php
/**
 * @copyright Copyright (c) 2018 www.evincemage.com
 */
namespace Evincemage\OrderComment\Observer;

class AddOrderCommentToOrder implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(\Magento\Framework\Event\Observer $observer) {
        
        /** @var $order \Magento\Sales\Model\Order * */
        $order = $observer->getEvent()->getOrder();
        
        /** @var $quote \Magento\Quote\Model\Quote * */
        $quote = $observer->getEvent()->getQuote();

        $order->setData('em_order_comment', $quote->getEmOrderComment());
    }

}
