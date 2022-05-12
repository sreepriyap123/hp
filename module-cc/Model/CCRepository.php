<?php declare(strict_types=1);
/**
 * Copyright © 2022 HP. All rights reserved.
 */

namespace HP\CC\Model;

use HP\CC\Api\Data\CCInterfaceFactory;
use HP\CC\Api\CCRepositoryInterface;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use HP\CC\Model\CCFactory as CCFactory;
use HP\CC\Model\ResourceModel\CC as CCResourceModel;
use Magento\Framework\Api\SearchCriteriaInterface;

class CCRepository implements CCRepositoryInterface
{
    /**
     * @var HP\CC\Model\ResourceModel\CC $ccResource
     */
    private $ccResource;
    /**
     * @var Magento\Framework\Api\DataObjectHelper $dataObjectHelper
     */
    private $dataObjectHelper;
    /**
     * @var Magento\Framework\Reflection\DataObjectProcessor $dataObjectProcessor
     */
    private $dataObjectProcessor;
    /**
     * @var HP\CC\Api\Data\CCInterface $dataCcFactory
     */
    private $dataCcFactory;
    /**
     * @var HP\CC\Model\CCFactory $ccFactory
     */
    private $ccFactory;

    /**
     * @var HP\CC\Api\Data\CCInterfaceFactory
     */
    private $ccInterfaceFactory;

    /**
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param CCFactory $ccFactory
     * @param CCResourceModel $ccResource
     * @param CCInterfaceFactory $ccInterface
     */
    public function __construct(
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        CCFactory $ccFactory,
        CCResourceModel $ccResource,
        ccInterfaceFactory $ccInterface
    ) {
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->ccFactory = $ccFactory;
        $this->ccResource = $ccResource;
        $this->ccInterface = $ccInterface;
    }

    /**
     * Save the data
     *
     * @param  \HP\CC\Api\Data\CCInterface $ccInterface
     * @return \HP\CC\Api\Data\CCInterface
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(\HP\CC\Api\Data\CCInterface $ccInterface)
    {
        try {
            $this->ccResource->save($ccInterface);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __('Could not save the details %1', $exception->getMessage()),
                $exception
            );
        }
        return $ccInterface;
    }
}
