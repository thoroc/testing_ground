<?php

namespace Absolvent\FuzzyText;

class AggregatedMatcher implements AggregatedMatcherInterface
{
    use GenericMatcherTrait;

    /**
     * @var array[\Absolvent\FuzzyText\MatcherInterface...]
     */
    private $matchers = [];

    /**
     * @param \Absolvent\FuzzyText\MatcherInterface $matcher
     * @param integer $weight the higher number, the more impact matcher will
     *                        have on final matching result
     * @return void
     */
    public function addMatcher(MatcherInterface $matcher, $weight = 1)
    {
        if (!isset($this->matchers[$weight])) {
            $this->matchers[$weight] = [];
        }

        $this->matchers[$weight][] = $matcher;
    }

    /**
     * @param \Absolvent\FuzzyText\MatcherInterface $matcher
     * @return void
     */
    public function removeMatcher(MatcherInterface $matcher)
    {
        foreach ($this->matchers as $weight => $matchers) {
            if (false !== ($key = array_search($matcher, $matchers, true))) {
                unset($this->matchers[$weight][$key]);
            }
        }
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
        $totalMatchersWeight = 0;
        $result = 0;

        foreach ($this->matchers as $weight => $matchers) {
            foreach ($matchers as $matcher) {
                $totalMatchersWeight += $weight;
                $result += $weight * $matcher->wordListsCompare($first, $second, $threshold);
            }
        }

        return $result / $totalMatchersWeight;
    }
}
