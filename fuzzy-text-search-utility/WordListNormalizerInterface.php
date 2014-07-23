<?php

namespace Absolvent\FuzzyText;

interface WordListNormalizerInterface
{
    const DEFAULT_WORD_LIST_THRESHOLD = 0.62;

    /**
     * @param mixed $wordList
     * @param float $threshold parameter between 0 and 1
     * @return WordListInterface
     */
    function normalizeWordList($wordList, $threshold = self::DEFAULT_WORD_LIST_THRESHOLD);
}
