<?php
/**
 * Copyright © 2017 H&O E-commerce specialisten B.V. (http://www.h-o.nl/)
 * See LICENSE.txt for license details.
 */

namespace Ho\CompanySwitcher\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;

class UpgradeData implements UpgradeDataInterface
{
    /**
     * {@inheritdoc}
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '0.1.1') < 0) {
            $connection = $setup->getConnection();

            $connection->addColumn(
                $setup->getTable('quote'),
                'own_reference',
                [
                    'type'      => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length'    => 255,
                    'comment'   =>'Own Reference'
                ]
            );

            $connection->addColumn(
                $setup->getTable('sales_order'),
                'own_reference',
                [
                    'type'      => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length'    => 255,
                    'comment'   =>'Own Reference'
                ]
            );
        }

        $setup->endSetup();
    }
}
