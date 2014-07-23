<?php

namespace Absolvent\FuzzyText;

use BadMethodCallException;
use DomainException;

trait WordListNormalizerAwareProxyTrait
{
    /**
     * @var \Absolvent\FuzzyText\WordListNormalizerInterface $wordListNormalizer
     */
    private $wordListNormalizer = null;

    /**
     * @param mixed $wordList
     * @param float $threshold parameter between 0 and 1
     * @return WordListInterface
     * @throws BadMethodCallException if local wordlist normalizer is undefined
     * @throws DomainException
     */
    public function normalizeWordList($wordList, $threshold = SieveInterface::DEFAULT_LOWER_THRESHOLD)
    {
        if (!($this->wordListNormalizer instanceof WordListNormalizerInterface)) {
            throw new BadMethodCallException('Internal "WordListNormalizer" is not set thus calling it is not possible.');
        }

        $wordList = $this->wordListNormalizer->normalizeWordList($wordList, $threshold);
        if (!($wordList instanceof WordListInterface)) {
            throw new DomainException(sprintf('"%s::normalizeWordList" returned something else than "%s\WordListInterface"', get_class($this->wordListNormalizer), __NAMESPACE__));
        }

        return $wordList;
    }

    /**
     * @param \Absolvent\FuzzyText\WordListNormalizerInterface $wordListNormalizer (optional) (default: null)
     * @return WordListInterface
     */
    public function setWordListNormalizer(WordListNormalizerInterface $wordListNormalizer = null)
    {
        $this->wordListNormalizer = $wordListNormalizer;
    }
}
