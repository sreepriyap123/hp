<?php declare(strict_types=1);
/**
 * Copyright © 2022 HP. All rights reserved.
 */

namespace HP\Faq\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\FilterGroupBuilder;
use Magento\Framework\Api\Search\FilterGroup;
use Magento\Framework\Api\SortOrderBuilder;
use HP\Faq\Api\FaqRepositoryInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;

/**
 * Faqs data resolver
 */
class Faqs implements ResolverInterface
{
    /**
     * Translator field from graphql to collection field
     *
     * @var string[]
     */
    private $fieldTranslatorArray = [
        'faqId' => 'faq_id',
    ];

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var FAQRepositoryInterface
     */
    private $faqRepository;

    /**
     * @var FilterBuilder
     */
    private $filterBuilder;

    /**
     * @var FilterGroupBuilder
     */
    private $filterGroupBuilder;

    /**
     * @var SortOrderBuilder
     */
    private $sortOrderBuilder;

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;
 
    /**
     * @param FaqRepositoryInterface $faqRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param FilterBuilder $filterBuilder
     * @param FilterGroupBuilder $filterGroupBuilder
     * @param SortOrderBuilder $sortOrderBuilder
     * @param ScopeConfigInterface $scopeConfig
     * @param string[] $fieldTranslatorArray
     */
    public function __construct(
        FaqRepositoryInterface $faqRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        FilterBuilder $filterBuilder,
        FilterGroupBuilder $filterGroupBuilder,
        SortOrderBuilder $sortOrderBuilder,
        ScopeConfigInterface $scopeConfig,
        array $fieldTranslatorArray = []
    ) {
        $this->faqRepository = $faqRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->filterBuilder = $filterBuilder;
        $this->filterGroupBuilder = $filterGroupBuilder;
        $this->sortOrderBuilder = $sortOrderBuilder;
        $this->scopeConfig = $scopeConfig;
        $this->fieldTranslatorArray = array_replace($this->fieldTranslatorArray, $fieldTranslatorArray);
    }

    /**
     * @inheritDoc
     */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {
        if ($args['currentPage'] < 1) {
            throw new GraphQlInputException(__('currentPage value must be greater than 0.'));
        }
        // if ($args['pageSize'] < 1) {
        //     throw new GraphQlInputException(__('pageSize value must be greater than 0.'));
        // }

        try {
            $searchResult = $this->getSearchResult($args);
        } catch (InputException $e) {
            throw new GraphQlInputException(__($e->getMessage()));
        }
        if (! $searchResult->getTotalCount()) {
            throw new GraphQlNoSuchEntityException(
                __(
                    'Could not find faqs associated with the filters',
                    []
                )
            );
        }
        return [
            'items' => $this->formatFaqArray($searchResult->getItems()),
            'total_count'=> $searchResult->getTotalCount(),
            'page_size' => $searchResult->getSearchCriteria()->getPageSize(),
            'current_page' => $searchResult->getSearchCriteria()->getCurrentPage()
        ];
    }

    /**
     * Format faq collection for graphql schema.
     *
     * @param FaqInterface[] $faqCollection
     * @return array
     */
    private function formatFaqArray($faqCollection)
    {
        $faqsArray = [];
        foreach ($faqCollection as $faqModel) {
          
            $faqsArray[] = [
                'id' => $faqModel['faq_id'],
                'question' => $faqModel['question'],
                'answer' => $faqModel['answer']
            ];
        }
        return $faqsArray;
    }
   
    /**
     * Get search result from graphql query arguments
     *
     * @param array $args
     * @return \HP\Faq\Api\Data\FaqSearchResultInterface
     * @throws InputException
     */
    private function getSearchResult(array $args)
    {
        $filterGroups = $this->createFilterGroups($args);
        if (! empty($filterGroups)) {
            $this->searchCriteriaBuilder->setFilterGroups($filterGroups);
        }
        
        if (isset($args['currentPage'])) {
            $this->searchCriteriaBuilder->setCurrentPage($args['currentPage']);
        }

        // if (isset($args['pageSize'])) {
        //     $this->searchCriteriaBuilder->setPageSize($args['pageSize']);
        // }
        $this->searchCriteriaBuilder->setPageSize($this->getPageSize());
        $sortOrder = $this->sortOrderBuilder->setField('sort_order')->setDirection('ASC')->create();

        $this->searchCriteriaBuilder->setSortOrders([$sortOrder]);

        return $this->faqRepository->getList($this->searchCriteriaBuilder->create());
    }
    
    /**
     * Get Page Size configuration.
     *
     * @return int
     */
    public function getPageSize()
    {
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        $pageSize = $this->scopeConfig->getValue('cms/general/page_size', $storeScope);
        if (! $pageSize) {
            $pageSize = 10;
        }
        return $pageSize;
    }

    /**
     * Create filter for filtering the faqs.
     *
     * @param array $args
     * @return FilterGroup[]
     */
    public function createFilterGroups(
        array $args
    ): array {
        $filterGroups = [];

        if (isset($args['filter'])) {
            $filters = [];
            foreach ($args['filter'] as $field => $cond) {
                if (isset($this->fieldTranslatorArray[$field])) {
                    $field = $this->fieldTranslatorArray[$field];
                }
                foreach ($cond as $condType => $value) {
                    $filters = []; //to add and conditions
                    if ($condType === 'match') {
                        if (is_array($value)) {
                            throw new InputException(__('Invalid match filter'));
                        }
                        $searchValue = str_replace('%', '', $value);
                        $filters[] = $this->filterBuilder->setField($field)
                            ->setValue("%{$searchValue}%")
                            ->setConditionType('like')
                            ->create();
                    } else {
                        $filters[] = $this->filterBuilder->setField($field)
                            ->setValue($value)
                            ->setConditionType($condType)
                            ->create();
                    }
                    $this->filterGroupBuilder->setFilters($filters);
                    $filterGroups[] = $this->filterGroupBuilder->create();
                }
            }
        }
        return $filterGroups;
    }
}
