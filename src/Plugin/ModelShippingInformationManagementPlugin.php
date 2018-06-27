<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace Ho\CompanySwitcher\Plugin;

use Magento\Checkout\Api\Data\ShippingInformationInterface;
use Magento\Checkout\Model\ShippingInformationManagement;
use Magento\Framework\Exception\NoSuchEntityException;
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

    /**
     * @param ShippingInformationManagement $subject
     * @param                               $cartId
     * @param ShippingInformationInterface  $addressInformation
     *
     * @throws NoSuchEntityException
     *
     * @return array
     */
    public function beforeSaveAddressInformation(
        ShippingInformationManagement $subject,
        $cartId,
        ShippingInformationInterface $addressInformation
    ): array {
        $quote = $this->quoteRepository->getActive($cartId);
        $shippingAddress = $addressInformation->getShippingAddress();

        $quote->setData('own_reference', $shippingAddress->getExtensionAttributes()->getOwnReference());

        return [$cartId, $addressInformation];
    }
}
