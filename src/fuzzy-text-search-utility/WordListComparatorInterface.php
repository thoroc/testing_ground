<?php

namespace Absolvent\FuzzyText;

interface WordListComparatorInterface
{
    const DEFAULT_LOWER_THRESHOLD = 0.38;

    /**
     * @param \Absolvent\FuzzyText\WordListInterface $first
     * @param \Absolvent\FuzzyText\WordListInterface $second
     * @param float $threshold
     * @return float number between 0 and 1
     */
    function oneWayWordListsCompare(WordListInterface $first, WordListInterface $second, $threshold = self::DEFAULT_LOWER_THRESHOLD);

    /**
     * Order of WordList arguments do not matter here
     *
     * @param \Absolvent\FuzzyText\WordListInterface $first
     * @param \Absolvent\FuzzyText\WordListInterface $second
     * @param float $threshold
     * @return float number between 0 and 1
     */
    function twoWayWordListsCompare(WordListInterface $first, WordListInterface $second, $threshold = self::DEFAULT_LOWER_THRESHOLD);
}
