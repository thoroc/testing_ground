<?php

namespace Absolvent\FuzzyText;

interface WordListComparatorAwareInterface
{
    /**
     * @param \Absolvent\FuzzyText\WordListInterface $first (optional) (default: null)
     */
    function setWordListComparator(WordListComparatorInterface $wordListComparatorInterface = null);
}
