<?php

namespace Absolvent\FuzzyText;

interface WordListAnalyzerInterface
{
    const DEFAULT_LOWER_THRESHOLD = 0.38;

    /**
     * @param \Absolvent\FuzzyText\WordListInterface $wordList
     * @param integer $threshold
     * @return array
     */
    function analyzeWordList(WordListInterface $wordList, $threshold = self::DEFAULT_LOWER_THRESHOLD);
}
