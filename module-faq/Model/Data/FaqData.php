<?php
/**
 * Copyright © 2022 HP. All rights reserved.
 */

declare(strict_types=1);

namespace HP\Faq\Model\Data;

use Magento\Framework\Model\AbstractModel;
use HP\Faq\Model\ResourceModel\Faq as ResourceModel;
use HP\Faq\Api\Data\FaqInterface;

/**
 * Class FaqData defines the model class
 */
class FaqData extends AbstractModel implements FaqInterface
{
    /**
     * FaqData constructor
     */
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    /**
     * Gets the FaqId
     *
     * @return int
     */
    public function getFaqId()
    {
        return $this->getData(self::FAQ_ID);
    }

    /**
     * Sets the FaqId
     *
     * @param  int $faqId
     * @return int
     */
    public function setFaqId($faqId)
    {
        return $this->setData(self::FAQ_ID, $faqId);
    }

    /**
     * Gets the Question
     *
     * @return string
     */
    public function getQuestion()
    {
        return $this->getData(self::QUESTION);
    }

    /**
     * Sets the Question
     *
     * @param  string $question
     * @return string
     */
    public function setQuestion($question)
    {
        return $this->setData(self::QUESTION, $question);
    }

    /**
     * Gets the Answer
     *
     * @return string
     */
    public function getAnswer()
    {
        return $this->getData(self::ANSWER);
    }

    /**
     * Sets the Answer
     *
     * @param  string $answer
     * @return string
     */
    public function setAnswer($answer)
    {
        return $this->setData(self::ANSWER, $answer);
    }

    /**
     * Gets the sort order
     *
     * @return int
     */
    public function getSortOrder()
    {
        return $this->getData(self::SORT_ORDER);
    }

    /**
     * Sets the sort order
     *
     * @param  int $sortOrder
     * @return int
     */
    public function setSortOrder($sortOrder)
    {
        return $this->setData(self::SORT_ORDER, $sortOrder);
    }
}
