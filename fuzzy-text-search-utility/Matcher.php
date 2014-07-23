<?php

namespace Absolvent\FuzzyText;

class Matcher implements MatcherInterface, WordListComparatorAwareInterface, WordListNormalizerAwareInterface
{
    use GenericMatcherTrait;
    use WordListNormalizerAwareProxyTrait;

    /**
     * @var \Absolvent\FuzzyText\WordListComparatorInterface $wordListComparator
     */
    private $wordListComparator = null;

    /**
     * @param \Absolvent\FuzzyText\WordListComparatorInterface $wordListComparator (optional) (default: null)
     * @param \Absolvent\FuzzyText\WordListNormalizerInterface $wordListNormalizer (optional) (default: null)
     */
    public function __construct(WordListComparatorInterface $wordListComparator = null, WordListNormalizerInterface $wordListNormalizer = null)
    {
        $this->setWordListComparator($wordListComparator);
        $this->setWordListNormalizer($wordListNormalizer);
    }

    /**
     * @param \Absolvent\FuzzyText\WordListComparatorInterface
     * @return void
     */
    public function setWordListComparator(WordListComparatorInterface $wordListComparator = null)
    {
        $this->wordListComparator = $wordListComparator;
    }

    /**
     * Order of WordList arguments do not matter here
     *
     * @param mixed $first
     * @param mixed $second
     * @param float $threshold
     * @return float number between 0 and 1
     */
    public function wordListsCompare($first, $second, $threshold = WordListComparatorInterface::DEFAULT_LOWER_THRESHOLD)
    {
        if (!($this->wordListComparator instanceof WordListComparatorInterface)) {
            throw new BadMethodCallException('Internal "WordListComparator" is not set thus calling it is not possible.');
        }

        $first = $this->normalizeWordList($first, $threshold);
        $second = $this->normalizeWordList($second, $threshold);

        return $this->wordListComparator->twoWayWordListsCompare($first, $second, $threshold);
    }
}
