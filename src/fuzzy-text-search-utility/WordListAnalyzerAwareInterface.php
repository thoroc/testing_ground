<?php

namespace Absolvent\FuzzyText;

interface WordListAnalyzerAwareInterface
{
    /**
     * @param \Absolvent\FuzzyText\WordListAnalyzerInterface $wordListAnalyzer (optional) (default: null)
     * @return WordListInterface
     */
    function setWordListAnalyzer(WordListAnalyzerInterface $wordListAnalyzer = null);
}
