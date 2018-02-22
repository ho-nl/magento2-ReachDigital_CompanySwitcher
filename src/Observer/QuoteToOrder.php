<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */

namespace Ho\CompanySwitcher\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class QuoteToOrder implements ObserverInterface
{
    /**
     * Copy own reference field from quote to order.
     *
     * Note: Done this way since fieldset XML sales_convert_quote is not working (yet).
     * @see https://github.com/magento/magento2/issues/5823
     *
     * @param Observer $observer
     */
    public function execute(Observer $observer)
    {
        $quote = $observer->getData('quote');
        $order = $observer->getData('order');

        $order->setData('own_reference', $quote->getData('own_reference'));
    }
}
