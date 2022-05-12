<?php
declare(strict_types=1);
/**
 * Copyright © 2022 HP. All rights reserved.
 */

namespace HP\Faq\Api\Data;

interface FaqSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * Get faq list.
     *
     * @return \HP\Faq\Api\Data\FaqInterface[]
     */
    public function getItems();

    /**
     * Set faq list.
     *
     * @param \HP\Faq\Api\Data\FaqInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
