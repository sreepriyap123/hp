<?php
declare(strict_types = 1);
/**
 *
 * Copyright © 2022 HP. All rights reserved.
 */

namespace HP\Orders\Model\ResourceModel\Report\RevenueDetails\Grid;

use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;
use HP\Orders\Model\RevenueDetails;
use Magento\Framework\Api;
use Magento\Framework\Event\ManagerInterface as EventManager;
use Magento\Framework\Data\Collection\Db\FetchStrategyInterface as FetchStrategy;
use Magento\Framework\Data\Collection\EntityFactoryInterface as EntityFactory;
use Psr\Log\LoggerInterface as Logger;
use Magento\Eav\Api\AttributeRepositoryInterface;

/**
 * Class Collection
 * Collection for displaying grid
 */
class Collection extends SearchResult
{
    
    /**
     * constructor
     *
     * @param EntityFactory $entityFactory
     * @param Logger $logger
     * @param FetchStrategy $fetchStrategy
     * @param EventManager $eventManager
     * @param AttributeRepositoryInterface $attrRepoInt
     * @param string $mainTable
     * @param string $resourceModel
     * @param RevenueDetails $revenueDetailsModel
     */
    public function __construct(
        EntityFactory $entityFactory,
        Logger $logger,
        FetchStrategy $fetchStrategy,
        EventManager $eventManager,
        AttributeRepositoryInterface $attrRepoInt,
        $mainTable,
        $resourceModel,
        RevenueDetails $revenueDetailsModel
    ) {
        $this->revenueDetails = $revenueDetailsModel;
        $this->attrRepoInt = $attrRepoInt;
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $mainTable, $resourceModel);
    }
    
     /**
      * Collection
      */
    protected function _initSelect()
    {
        $this->addFilterToMap('created_at', 'sot.created_at');
        $this->addFilterToMap('billing_street', 'soat_billing.street');
        $this->addFilterToMap('shipping_street', 'soat_shipping.street');
        $this->addFilterToMap('billing_city', 'soat_billing.city');
        $this->addFilterToMap('shipping_city', 'soat_shipping.city');
        $this->addFilterToMap('billing_region', 'soat_billing.region');
        $this->addFilterToMap('shipping_region', 'soat_shipping.region');
        $this->addFilterToMap('customer_fname', 'soat_shipping.firstname');
        $this->addFilterToMap('customer_lname', 'soat_shipping.lastname');
        parent::_initSelect();
        $this->getSelect()
                   ->joinLeft(
                       ['sot' => 'sales_order'],
                       'sot.entity_id = main_table.order_id ',
                       ['sot.grand_total','sot.discount_amount as discount','sot.total_refunded','sot.increment_id']
                   )->where('main_table.parent_item_id IS NULL')
                   ->joinLeft(
                       ['soat_shipping' => 'sales_order_address'],
                       'soat_shipping.parent_id = main_table.order_id AND soat_shipping.address_type =  \'shipping\'',
                       ['soat_shipping.telephone as shipping_telephone', 'soat_shipping.city as shipping_city',
                       'soat_shipping.postcode as shipping_postcode',
                       'soat_shipping.street as shipping_street',
                       'soat_shipping.region as shipping_region',
                       'soat_shipping.firstname as customer_fname',
                       'soat_shipping.lastname as customer_lname']
                   )
                    ->joinLeft(
                        ['soat_billing' => 'sales_order_address'],
                        'soat_billing.parent_id = main_table.order_id AND soat_billing.address_type = \'billing\'',
                        ['soat_billing.telephone as billing_telephone', 'soat_billing.city as billing_city',
                         'soat_billing.postcode as billing_pincode',
                         'soat_billing.street as billing_street','soat_billing.region as billing_region']
                    );
    }

    /**
     * Get search criteria.
     *
     * @return \Magento\Framework\Api\SearchCriteriaInterface|null
     */
    public function getSearchCriteria()
    {
        return null;
    }

    /**
     * Set search criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     *
     * @return $this
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function setSearchCriteria(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria = null
    ) {
        return $this;
    }

    /**
     * Get total count.
     *
     * @return int
     */
    public function getTotalCount()
    {
        return $this->getSize();
    }

    /**
     * Set total count.
     *
     * @param int $totalCount
     *
     * @return $this
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function setTotalCount($totalCount)
    {
        return $this;
    }

    /**
     * Set items list.
     *
     * @param \Magento\Framework\Api\ExtensibleDataInterface[] $items
     *
     * @return $this
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function setItems(array $items = null)
    {
        return $this;
    }
}
