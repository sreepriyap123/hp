<?php declare(strict_types=1);
/**
 * Copyright © 2021 HP. All rights reserved.
*/

namespace HP\Orders\Plugin;

use Magento\Quote\Model\Quote as Subject;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\CatalogInventory\Api\StockRegistryInterface;

class Quote
{
    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var StockRegistryInterface
     */
    protected $stockRegistryInterface;

    /**
     * @param ScopeConfigInterface $scopeConfig
     * @param StockRegistryInterface $stockRegistryInterface
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        StockRegistryInterface $stockRegistryInterface
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->stockRegistryInterface = $stockRegistryInterface;
    }
    
    /**
     * @inheritdoc
     */
    public function beforeAddProduct(
        Subject $subject,
        \Magento\Catalog\Model\Product $product,
        $request = null,
        $processMode = \Magento\Catalog\Model\Product\Type\AbstractType::PROCESS_MODE_FULL
    ) {
        $enable = $this->scopeConfig->getValue(
            'checkout/hp_restrictions/enable_cartrestrictions',
            ScopeInterface::SCOPE_STORE
        );
        if ($enable && $subject->getItemsCount()) {
            $isAllowed = 0;
            if (!$request instanceof \Magento\Framework\DataObject) {
                throw new \Magento\Framework\Exception\LocalizedException(
                    __('We found an invalid request for adding product to quote.')
                );
            }
    
            if (!$product->isSalable()) {
                throw new \Magento\Framework\Exception\LocalizedException(
                    __('Product that you are trying to add is not available.')
                );
            }
    
            $cartId = $subject->getId();
            $productId = $product->getId();

            $cartCandidates = $product->getTypeInstance()->prepareForCartAdvanced($request, $product, $processMode);

            /**
             * Error message
             */
            if (is_string($cartCandidates) || $cartCandidates instanceof \Magento\Framework\Phrase) {
                return (string)$cartCandidates;
            }

            /**
             * If prepare process return one object
             */
            if (!is_array($cartCandidates)) {
                $cartCandidates = [$cartCandidates];
            }
            $parentItem = null;
            foreach ($cartCandidates as $candidate) {
                // Child items can be sticked together only within their parent
                $stickWithinParent = $candidate->getParentProductId() ? $parentItem : null;
                $candidate->setStickWithinParent($stickWithinParent);
    
                $item = $subject->getItemByProduct($candidate);
                if (!$item) {
                    $isAllowed = 0;
                } else {
                    $isAllowed = 1;
                }
            }
            
            if ($isAllowed) {
                return [$product, $request, $processMode];
            } else {
                $errorMessage = $this->scopeConfig->getValue(
                    'checkout/hp_restrictions/cartrestriction_message',
                    ScopeInterface::SCOPE_STORE
                );
                if (! $errorMessage) {
                    $errorMessage = "You can’t add new item for this order";
                }
                throw new LocalizedException(
                    __($errorMessage)
                );
            }
        }
        return [$product, $request, $processMode];
    }

    /**
     * Merge quotes
     *
     * @param Subject $subject
     * @param Quote $quote
     * @return $this
     */
    public function beforeMerge(Subject $subject, $quote)
    {
        $isAllowed = 0;
        $maxQtyError = 0;
        if ($subject->getItemsCount()) {
            foreach ($quote->getAllVisibleItems() as $item) {
                foreach ($subject->getAllItems() as $quoteItem) {
                    if ($quoteItem->compare($item)) {
                        $isAllowed = 1;
                        $totalQty = $quoteItem->getQty() + $item->getQty();

                        $stockManager = $this->stockRegistryInterface->getStockItem($quoteItem->getProductId());
                        $maxQtyForProduct = $stockManager->getMaxSaleQty();
                        if ($totalQty >$maxQtyForProduct) {
                            $maxQtyError = 1;
                        }
                        break;
                    }
                }
            }
        }
        if ($maxQtyError) {
            throw new LocalizedException(
                __('The requested qty exceeds the maximum qty allowed in shopping cart.')
            );
        }

        $enable = $this->scopeConfig->getValue(
            'checkout/hp_restrictions/enable_cartrestrictions',
            ScopeInterface::SCOPE_STORE
        );
        if ($enable && $subject->getItemsCount()) {
            /*$isAllowed = 0;
            foreach ($quote->getAllVisibleItems() as $item) {
                foreach ($subject->getAllItems() as $quoteItem) {
                    if ($quoteItem->compare($item)) {
                        $isAllowed = 1;
                        break;
                    }
                }
            }*/
            if ($isAllowed) {
                return [$quote];

            } else {
                $errorMessage = $this->scopeConfig->getValue(
                    'checkout/hp_restrictions/cartrestriction_message',
                    ScopeInterface::SCOPE_STORE
                );
                if (! $errorMessage) {
                    $errorMessage = "You can’t add new item for this order";
                }
                throw new LocalizedException(
                    __($errorMessage)
                );
            }
           
        }
        return [$quote];
    }
}
