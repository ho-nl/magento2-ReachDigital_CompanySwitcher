<?php
/**
 * Copyright © 2017 H&O E-commerce specialisten B.V. (http://www.h-o.nl/)
 * See LICENSE.txt for license details.
 */

namespace Ho\CompanySwitcher\Plugin;

use Magento\Sales\Api\Data\OrderExtensionFactory;
use Magento\Sales\Api\Data\OrderInterface;

class ApiDataOrderInterfacePlugin
{
    /** @var OrderExtensionFactory orderExtensionFactory */
    private $orderExtensionFactory;

    /**
     * @param OrderExtensionFactory $orderExtensionFactory
     */
    public function __construct(OrderExtensionFactory $orderExtensionFactory)
    {
        $this->orderExtensionFactory = $orderExtensionFactory;
    }

    public function afterGetExtensionAttributes(OrderInterface $entity, $extension)
    {
        if ($extension === null) {
            $extension = $this->orderExtensionFactory->create();
        }

        return $extension;
    }
}
