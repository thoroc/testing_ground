<?php

namespace Absolvent\FuzzyText\Tests\MatcherTest;

use Absolvent\FuzzyText\Matcher;
use Absolvent\FuzzyText\OverallSimilarityWordListComparator;
use Absolvent\FuzzyText\SelfInclusionWordListAnalyzer;
use Absolvent\FuzzyText\Sieve;
use Absolvent\FuzzyText\Tests\AbstractMatcherTest;
use Absolvent\FuzzyText\WordListNormalizer;

class GenericMatcherTest extends AbstractMatcherTest
{
    private function createMatcher()
    {
        $matcher = new Matcher;

        $matcher->setWordListComparator(new OverallSimilarityWordListComparator);

        $wordListNormalizer = new WordListNormalizer;
        $matcher->setWordListNormalizer($wordListNormalizer);

        return $matcher;
    }

    public function testFilteringWordList()
    {
        $matcher = $this->createMatcher();

        $result = $matcher->filterWordLists('foo', ['foo', 'bar', 'foor']);

        $this->assertSame(['foo', 'foor'], $result);
    }

    public function testFindingOneClosestWordList()
    {
        $matcher = $this->createMatcher();

        $result = $matcher->findOneClosestWordList('boo', ['foo', 'bar', 'foor']);

        $this->assertSame('foo', $result);
    }
}
