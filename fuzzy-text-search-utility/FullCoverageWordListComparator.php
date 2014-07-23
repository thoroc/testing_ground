<?php

namespace Absolvent\FuzzyText;

class FullCoverageWordListComparator implements WordListComparatorInterface
{
    /**
     * @param \Absolvent\FuzzyText\WordListInterface $first
     * @param \Absolvent\FuzzyText\WordListInterface $second
     * @param float $threshold
     * @return float number between 0 and 1
     */
    function oneWayWordListsCompare(WordListInterface $first, WordListInterface $second, $threshold = self::DEFAULT_LOWER_THRESHOLD)
    {
        $matchedWords = 0;

        foreach ($first as $firstWord) {
            if ($second->hasWord($firstWord)) {
                $matchedWords += 1;
            }
        }

        $firstCount = count($first);
        if ($firstCount < 1) {
            return 0;
        }

        return (float) $matchedWords / $firstCount;
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
        $totalWordsCount = count($first) + count($second);

        $first = iterator_to_array($first);
        $second = iterator_to_array($second);

        $mutualWords = array_intersect($first, $second);
        $mutualWords = array_fill_keys($mutualWords, true);
        $mutualWordsCount = 0;

        foreach ($first as $firstWord) {
            if (isset($mutualWords[$firstWord])) {
                $mutualWordsCount += 1;
            }
        }

        foreach ($second as $secondWord) {
            if (isset($mutualWords[$secondWord])) {
                $mutualWordsCount += 1;
            }
        }

        if ($totalWordsCount < 1) {
            return 0;
        }

        return (float) $mutualWordsCount / $totalWordsCount;
    }
}
