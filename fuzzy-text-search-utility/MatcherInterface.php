<?php

namespace Absolvent\FuzzyText;

interface MatcherInterface
{
    const DEFAULT_LOWER_THRESHOLD = 0.38;

    /**
     * @param string $pattern
     * @param array $wordLists
     * @param float $threshold
     * @return array
     */
    function filterWordLists($pattern, array $wordLists, $threshold = self::DEFAULT_LOWER_THRESHOLD);

    /**
     * Find one closest word above given match threshold
     *
     * @param string $pattern
     * @param array $wordLists
     * @param float $threshold
     * @return null|string
     */
    function findOneClosestWordList($pattern, array $wordLists, $threshold = self::DEFAULT_LOWER_THRESHOLD);

    /**
     * Order of WordList arguments do not matter here
     *
     * @param mixed $first
     * @param mixed $second
     * @param float $threshold
     * @return float number between 0 and 1
     */
    function wordListsCompare($first, $second, $threshold = WordListComparatorInterface::DEFAULT_LOWER_THRESHOLD);
}
