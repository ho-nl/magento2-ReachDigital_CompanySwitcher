<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace Ho\CompanySwitcher\Plugin;

use Magento\Sales\Api\Data\OrderExtensionFactory;
use Magento\Sales\Api\Data\OrderExtensionInterface;
use Magento\Sales\Api\Data\OrderInterface;

class ApiDataOrderInterfacePlugin
{
    /** @var OrderExtensionFactory $extensionFactory */
    private $extensionFactory;

    /**
     * @param OrderExtensionFactory $extensionFactory
     */
    public function __construct(OrderExtensionFactory $extensionFactory)
    {
        $this->extensionFactory = $extensionFactory;
    }

    /**
     * @param OrderInterface               $entity
     * @param OrderExtensionInterface|null $extensionAttributes
     *
     * @return OrderExtensionInterface
     */
    public function afterGetExtensionAttributes(
        OrderInterface $entity,
        OrderExtensionInterface $extensionAttributes = null
    ): OrderExtensionInterface {
        if ($extensionAttributes === null) {
            $extensionAttributes = $this->extensionFactory->create();
            $entity->setExtensionAttributes($extensionAttributes);
        }

        return $extensionAttributes;
    }
}
