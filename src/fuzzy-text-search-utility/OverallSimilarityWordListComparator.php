<?php

namespace Absolvent\FuzzyText;

class OverallSimilarityWordListComparator implements WordListComparatorInterface
{
    /**
     * @param \Absolvent\FuzzyText\WordListInterface $first
     * @param \Absolvent\FuzzyText\WordListInterface $second
     * @param float $threshold
     * @return array
     */
    private function analyzeWordLists(WordListInterface $first, WordListInterface $second, $threshold)
    {
        $first = implode(iterator_to_array($first));
        $firstStrlen = strlen($first);

        $second = implode(iterator_to_array($second));
        $secondStrlen = strlen($second);

        $levenshteinDistance = levenshtein($first, $second);
        $maximumPotentialDifference = max($firstStrlen, $secondStrlen);

        return [$firstStrlen, $secondStrlen, $levenshteinDistance, $maximumPotentialDifference];
    }

    /**
     * @param \Absolvent\FuzzyText\WordListInterface $first
     * @param \Absolvent\FuzzyText\WordListInterface $second
     * @param float $threshold
     * @return float number between 0 and 1
     */
    function oneWayWordListsCompare(WordListInterface $first, WordListInterface $second, $threshold = self::DEFAULT_LOWER_THRESHOLD)
    {
        list(
            $firstStrlen,
            $secondStrlen,
            $levenshteinDistance,
            $maximumPotentialDifference
        ) = $this->analyzeWordLists($first, $second, $threshold);

        $difference = $maximumPotentialDifference - $levenshteinDistance;
        
        if ($firstStrlen < 1) {
            return 0;
        }
        
        return (float) $difference / $firstStrlen;
    }

    /**
     * Order of WordList arguments do not matter here
     *
     * @param \Absolvent\FuzzyText\WordListInterface $first
     * @param \Absolvent\FuzzyText\WordListInterface $second
     * @param float $threshold
     * @return float number between 0 and 1
     */
    function twoWayWordListsCompare(WordListInterface $first, WordListInterface $second, $threshold = WordListComparatorInterface::DEFAULT_LOWER_THRESHOLD)
    {
        list(
            $firstStrlen,
            $secondStrlen,
            $levenshteinDistance,
            $maximumPotentialDifference
        ) = $this->analyzeWordLists($first, $second, $threshold);
        
        if ($maximumPotentialDifference < 1) {
            return 0;
        }

        return (float) (1 - ($levenshteinDistance / $maximumPotentialDifference));
    }
}
