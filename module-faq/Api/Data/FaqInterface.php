<?php
/**
 * Copyright © 2022 HP. All rights reserved.
 */

declare(strict_types=1);

namespace HP\Faq\Api\Data;

interface FaqInterface
{
    /**
     * Constants for keys of data array.
     */
    public const FAQ_ID = 'faq_id';
    public const QUESTION = 'question';
    public const ANSWER = 'answer';
    public const SORT_ORDER = 'sort_order';
    /**
     * Gets the FaqId.
     *
     * @api
     * @return int
     */
    public function getFaqId();
    /**
     * Sets the FaqId.
     *
     * @param  int $faqId
     * @return int
     */
    public function setFaqId($faqId);
    /**
     * Gets the Question
     *
     * @api
     * @return string
     */
    public function getQuestion();
    /**
     * Sets the Question.
     *
     * @param  string $question
     * @return string
     */
    public function setQuestion($question);
    /**
     * Gets the Answer
     *
     * @api
     * @return string
     */
    public function getAnswer();
    /**
     * Sets the Answer.
     *
     * @param  string $answer
     * @return string
     */
    public function setAnswer($answer);
    /**
     * Gets the sort order.
     *
     * @api
     * @return int
     */
    public function getSortOrder();
    /**
     * Sets the sort order.
     *
     * @param  int $sortOrder
     * @return int
     */
    public function setSortOrder($sortOrder);
}
