<?php

/**
 * Copyright © 2021 HP. All rights reserved.
 */

namespace HP\Orders\Setup\Patch\Schema;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\Patch\SchemaPatchInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * Add oms attributes to the table
 */

class AddOmsAttributes implements SchemaPatchInterface
{
    /**
     * @var \Magento\Framework\Setup
     */
    private $moduleDataSetup;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     */
    
    public function __construct(ModuleDataSetupInterface $moduleDataSetup)
    {
        $this->moduleDataSetup = $moduleDataSetup;
    }

    /**
     * @inheritdoc
     */
    public function apply()
    {
        $this->moduleDataSetup->startSetup();

        $this->moduleDataSetup->getConnection()->addColumn(
            $this->moduleDataSetup->getTable('sales_order_item'),
            'oms_order_id',
            [
               'type' => Table::TYPE_TEXT,
               'length' => 255,
               'nullable' => true,
               'comment'  => 'OMS Order ID',
            ]
        );
        $this->moduleDataSetup->getConnection()->addColumn(
            $this->moduleDataSetup->getTable('sales_order_item'),
            'oms_order_status',
            [
               'type' => Table::TYPE_TEXT,
               'length' => 255,
               'nullable' => true,
               'comment'  => 'OMS Order Status',
            ]
        );

        $this->moduleDataSetup->endSetup();
    }

    /**
     * @inheritdoc
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function getAliases()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public static function getVersion()
    {
        return '2.0.0';
    }
}
