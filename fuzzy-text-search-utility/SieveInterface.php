<?php

namespace Absolvent\FuzzyText;

interface SieveInterface
{
    const DEFAULT_LOWER_THRESHOLD = 0.38;

    /**
     * @param mixed $wordList
     * @param float $threshold parameter between 0 and 1
     * @param boolean $asArray whether to return response as array
     * @return array|WordListInterface
     */
    function filterWordList($wordList, $threshold = self::DEFAULT_LOWER_THRESHOLD, $asArray = true);

    /**
     * @param array $wordList
     * @param float $threshold parameter between 0 and 1
     * @param boolean $asArray whether to return response as array
     * @return array|WordListInterface
     */
    function filterWordLists(array $wordLists, $threshold = self::DEFAULT_LOWER_THRESHOLD, $asArray = true);

    /**
     * @param \Absolvent\FuzzyText\SieveInterface $previousSieve
     * @return void
     */
    function setPreviousSieve(SieveInterface $previousSieve);
}
