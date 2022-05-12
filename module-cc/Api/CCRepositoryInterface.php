<?php

/**
 * Copyright © 2022 HP. All rights reserved.
 */

namespace HP\CC\Api;

use HP\CC\Api\Data\CCInterface;

/**
 * Interface CCRepositoryInterface
 *
 * @api
 */
interface CCRepositoryInterface
{

   /**
    * Save Payment Data
    *
    * @param \HP\CC\Api\Data\CCInterface $data
    * @return \HP\CC\Api\Data\CCInterface
    * @throws \Magento\Framework\Exception\CouldNotSaveException
    */
    public function save(CCInterface $data);
}
