<?php

/**
 * Copyright © 2022 HP. All rights reserved.
 */

namespace HP\Orders\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Sales\Model\Order\StatusFactory;
use Magento\Sales\Model\ResourceModel\Order\StatusFactory as StatusResourceFactory;

class AddOrderStatus implements DataPatchInterface
{

    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @var StatusFactory
     */
    protected $statusFactory;

    /**
     * @var StatusResourceFactory
     */
    protected $statusResourceFactory;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param StatusFactory $statusFactory
     * @param StatusResourceFactory $statusResourceFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        StatusFactory $statusFactory,
        StatusResourceFactory $statusResourceFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->statusFactory = $statusFactory;
        $this->statusResourceFactory = $statusResourceFactory;
    }

    /**
     * @inheritdoc
     */
    public function apply()
    {
        $status = $this->statusFactory->create();
        $statusArray = [
            ['state'=>'new', 'status'=>'denied','label'=>'Denied', 'default'=>false],
            ['state'=>'processing', 'status'=>'approved','label'=>'Approved', 'default'=>true]
        ];
        foreach ($statusArray as $key => $value) {
            $status->setData([
                'status' => $value['status'],
                'label' => $value['label'],
            ]);
    
            /**
             * Save the new status
             */
            $statusResource = $this->statusResourceFactory->create();
            $statusResource->save($status);
    
            /**
             * Assign status to state
             */
            $status->assignState($value['state'], $value['default'], true);
        }

        return $this;
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
}
