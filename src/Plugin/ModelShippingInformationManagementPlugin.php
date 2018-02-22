<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */

namespace Ho\CompanySwitcher\Plugin;

use Magento\Checkout\Api\Data\ShippingInformationInterface;
use Magento\Checkout\Model\ShippingInformationManagement;
use Magento\Quote\Model\QuoteRepository;

class ModelShippingInformationManagementPlugin
{
    /** @var QuoteRepository $quoteRepository */
    private $quoteRepository;

    /**
     * @param QuoteRepository $quoteRepository
     */
    public function __construct(QuoteRepository $quoteRepository)
    {
        $this->quoteRepository = $quoteRepository;
    }

    public function beforeSaveAddressInformation(
        ShippingInformationManagement $subject,
        $cartId,
        ShippingInformationInterface $addressInformation
    ) {
        $quote = $this->quoteRepository->getActive($cartId);

        $shippingAddress = $addressInformation->getShippingAddress();

        $quote->setData('own_reference', $shippingAddress->getExtensionAttributes()->getOwnReference());
    }
}
