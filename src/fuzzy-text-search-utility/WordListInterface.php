<?php

namespace Absolvent\FuzzyText;

use countable;
use IteratorAggregate;

interface WordListInterface extends Countable, IteratorAggregate
{
    /**
     * @param string $word
     * @return void
     */
    function addWord($word);

    /**
     * @param string $word
     * @return integer
     */
    function countWordOccurences($word);

    /**
     * @return string
     */
    function getLongestWord();

    /**
     * @param string $word
     * @return boolean
     */
    function hasWord($word);

    /**
     * @param \Absolvent\FuzzyText\WordListInterface $otherWordList
     * @return boolean
     */
    function isCoveredByWordList(WordListInterface $otherWordList);

    /**
     * @param \Absolvent\FuzzyText\WordListInterface $otherWordList
     * @return void
     */
    function merge(WordListInterface $otherWordList);
}
