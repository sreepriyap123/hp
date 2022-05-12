<?php
/**
 * Copyright © 2022 HP. All rights reserved.
 */

declare(strict_types=1);

namespace HP\Faq\Model;

use HP\Faq\Model\ResourceModel\Faq\CollectionFactory;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var array
     */
    protected $loadedData;
    /**
     * Dataprovider constructor
     *
     * @param string            $name
     * @param string            $primaryFieldName
     * @param string            $requestFieldName
     * @param CollectionFactory $faqCollectionFactory
     * @param array             $meta
     * @param array             $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $faqCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $faqCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }
    /**
     * Get the FAQ details
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $faq) {
            $this->loadedData[$faq->getId()] = $faq->getData();
        }
        return $this->loadedData;
    }
}
