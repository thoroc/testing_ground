<?php

namespace Absolvent\FuzzyText\Tests\MatcherTest;

use Absolvent\FuzzyText\AggregatedMatcher;
use Absolvent\FuzzyText\FullCoverageWordListComparator;
use Absolvent\FuzzyText\Matcher;
use Absolvent\FuzzyText\OverallSimilarityWordListComparator;
use Absolvent\FuzzyText\Tests\AbstractMatcherTest;
use Absolvent\FuzzyText\WordListNormalizer;

class AggregatedMatcherTest extends AbstractMatcherTest
{
    private function createFullCoverageWordListMatcher()
    {
        $matcher = new Matcher;

        $matcher->setWordListComparator(new FullCoverageWordListComparator);

        $wordListNormalizer = new WordListNormalizer;
        $matcher->setWordListNormalizer($wordListNormalizer);

        return $matcher;
    }

    private function createOverallSimilarityWordListMatcher()
    {
        $matcher = new Matcher;

        $matcher->setWordListComparator(new OverallSimilarityWordListComparator);

        $wordListNormalizer = new WordListNormalizer;
        $matcher->setWordListNormalizer($wordListNormalizer);

        return $matcher;
    }

    public function testComparingWordListsWithOverallSimilarityWordListmatcher()
    {
        $matcher = new AggregatedMatcher;
        $matcher->addMatcher($this->createOverallSimilarityWordListMatcher());

        $result = $matcher->wordListsCompare('foo', ['foo', 'bar', 'foor']);

        $this->assertSame(0.3, $result);
    }

    public function testComparingWordListsWithFullCoverageWordListmatcher()
    {
        $matcher = new AggregatedMatcher;
        $matcher->addMatcher($this->createFullCoverageWordListMatcher());

        $result = $matcher->wordListsCompare('foo', ['foo', 'bar', 'foor']);

        $this->assertSame(0.5, $result);
    }

    public function testComparingWordListsWithMultipleMatchers()
    {
        $matcher = new AggregatedMatcher;
        $matcher->addMatcher($this->createOverallSimilarityWordListMatcher());
        $matcher->addMatcher($this->createFullCoverageWordListMatcher());

        $result = $matcher->wordListsCompare('foo', ['foo', 'bar', 'foor']);

        $this->assertSame(0.4, $result);
    }


    public function testComparingWordListsWithMultipleMatchersAndCustomWeights()
    {
        $matcher = new AggregatedMatcher;
        $matcher->addMatcher($this->createOverallSimilarityWordListMatcher(), 3);
        $matcher->addMatcher($this->createFullCoverageWordListMatcher());

        $result = $matcher->wordListsCompare('foo', ['foo', 'bar', 'foor']);

        $this->assertSame(0.35, $result);
    }

    public function testFilteringWordList()
    {
        $matcher = new AggregatedMatcher;
        $matcher->addMatcher($this->createOverallSimilarityWordListMatcher());

        $result = $matcher->filterWordLists('foo', ['foo', 'bar', 'foor']);

        $this->assertSame(['foo', 'foor'], $result);
    }

    public function testFindingOneClosestWordList()
    {
        $matcher = new AggregatedMatcher;
        $matcher->addMatcher($this->createOverallSimilarityWordListMatcher(), 3);
        $matcher->addMatcher($this->createFullCoverageWordListMatcher());

        $result = $matcher->findOneClosestWordList('boor', ['foo', 'bar', 'foor']);

        $this->assertSame('foor', $result);
    }
}
