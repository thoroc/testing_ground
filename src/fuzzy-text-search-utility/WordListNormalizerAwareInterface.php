<?php

namespace Absolvent\FuzzyText;

interface WordListNormalizerAwareInterface
{
    /**
     * @param \Absolvent\FuzzyText\WordListNormalizerInterface $wordListNormalizer (optional) (default: null)
     * @return \Absolvent\FuzzyText\WordListInterface
     */
    function setWordListNormalizer(WordListNormalizerInterface $wordListNormalizer = null);
}
