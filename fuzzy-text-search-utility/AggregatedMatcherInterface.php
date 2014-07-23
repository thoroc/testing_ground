<?php

namespace Absolvent\FuzzyText;

interface AggregatedMatcherInterface extends MatcherInterface
{
    /**
     * @param \Absolvent\FuzzyText\MatcherInterface $matcher
     * @param integer $weight the higher number, the more impact matcher will
     *                        have on final matching result
     * @return void
     */
    function addMatcher(MatcherInterface $matcher, $weight = 1);

    /**
     * @param \Absolvent\FuzzyText\MatcherInterface $matcher
     * @return void
     */
    function removeMatcher(MatcherInterface $matcher);
}
