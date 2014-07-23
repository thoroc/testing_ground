<?php

namespace Absolvent\FuzzyText;

trait GenericMatcherTrait
{
    /**
     * Order of WordList arguments do not matter here
     *
     * @param mixed $first
     * @param mixed $second
     * @param float $threshold
     * @return float number between 0 and 1
     */
    abstract public function wordListsCompare($first, $second, $threshold = WordListComparatorInterface::DEFAULT_LOWER_THRESHOLD);

    /**
     * @param string $pattern
     * @param array $wordLists
     * @param float $threshold
     * @return array
     */
    public function filterWordLists($pattern, array $wordLists, $threshold = WordListComparatorInterface::DEFAULT_LOWER_THRESHOLD)
    {
        $response = [];
        foreach ($wordLists as $wordList) {
            if ($threshold < $this->wordListsCompare($pattern, $wordList, $threshold)) {
                $response[] = $wordList;
            }
        }

        return $response;
    }

    /**
     * Find one closest word above given match threshold
     *
     * @param string $pattern
     * @param array $wordLists
     * @param float $threshold
     * @return null|WordListInterface
     */
    public function findOneClosestWordList($pattern, array $wordLists, $threshold = WordListComparatorInterface::DEFAULT_LOWER_THRESHOLD)
    {
        $closestWordList = null;
        $highestSimilarity = 0;
        foreach ($wordLists as $wordList) {
            $wordListSimilarity = $this->wordListsCompare($pattern, $wordList, $threshold);
            if ($threshold < $wordListSimilarity && $highestSimilarity < $wordListSimilarity) {
                $closestWordList = $wordList;
                $highestSimilarity = $wordListSimilarity;
            }
        }

        return $closestWordList;
    }
}
