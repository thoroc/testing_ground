<?php

namespace Absolvent\FuzzyText\Tests;

use Absolvent\FuzzyText\OverallSimilarityWordListComparator;
use Absolvent\FuzzyText\WordList;
use PHPUnit_Framework_TestCase;

class OverallSimilarityWordListComparatorTest extends PHPUnit_Framework_TestCase
{
    public function testOneWayWordListCompare()
    {
        $wordListCoverageComparator = new OverallSimilarityWordListComparator;

        $first = WordList::fromArray(['four']);
        $second = WordList::fromArray(['one', 'four', 'two']);

        $result = $wordListCoverageComparator->oneWayWordListsCompare($first, $second);

        $this->assertSame(1.0, $result);
    }

    public function testReversedOneWayWordListCompare()
    {
        $wordListCoverageComparator = new OverallSimilarityWordListComparator;

        $first = WordList::fromArray(['one', 'four', 'two']);
        $second = WordList::fromArray(['four']);

        $result = $wordListCoverageComparator->oneWayWordListsCompare($first, $second);

        $this->assertSame(0.4, $result);
    }

    public function testTwoWayWordListCompare()
    {
        $wordListCoverageComparator = new OverallSimilarityWordListComparator;

        $first = WordList::fromArray(['one', 'five', 'two', 'six', 'nine', 'two']);
        $second = WordList::fromArray(['one', 'two', 'three', 'four']);

        $result = $wordListCoverageComparator->twoWayWordListsCompare($first, $second);

        $this->assertSame(0.3, $result);
    }

    public function testTwoWayWordListCompareWithNoDifferences()
    {
        $wordListCoverageComparator = new OverallSimilarityWordListComparator;

        $first = WordList::fromArray(['one']);
        $second = WordList::fromArray(['one']);

        $result = $wordListCoverageComparator->twoWayWordListsCompare($first, $second);

        $this->assertSame(1.0, $result);
    }
}
