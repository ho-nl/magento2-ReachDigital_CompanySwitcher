<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace Ho\CompanySwitcher\Plugin;

use Magento\Quote\Api\Data\AddressExtensionFactory;
use Magento\Quote\Api\Data\AddressExtensionInterface;
use Magento\Quote\Api\Data\AddressInterface;

class ApiDataAddressInterfacePlugin
{
    /** @var AddressExtensionFactory $extensionFactory */
    private $extensionFactory;

    /**
     * @param AddressExtensionFactory $extensionFactory
     */
    public function __construct(AddressExtensionFactory $extensionFactory)
    {
        $this->extensionFactory = $extensionFactory;
    }

    /**
     * @param AddressInterface               $entity
     * @param AddressExtensionInterface|null $extensionAttributes
     *
     * @return AddressExtensionInterface
     */
    public function afterGetExtensionAttributes(
        AddressInterface $entity,
        AddressExtensionInterface $extensionAttributes = null
    ): AddressExtensionInterface {
        if ($extensionAttributes === null) {
            $extensionAttributes = $this->extensionFactory->create();
            $entity->setExtensionAttributes($extensionAttributes);
        }

        return $extensionAttributes;
    }
}
