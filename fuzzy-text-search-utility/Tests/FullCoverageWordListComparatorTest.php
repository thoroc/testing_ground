<?php

namespace Absolvent\FuzzyText\Tests;

use Absolvent\FuzzyText\FullCoverageWordListComparator;
use Absolvent\FuzzyText\WordList;
use PHPUnit_Framework_TestCase;

class FullCoverageWordListComparatorTest extends PHPUnit_Framework_TestCase
{
    public function testOneWayWordListCompare()
    {
        $wordListCoverageComparator = new FullCoverageWordListComparator;

        $first = WordList::fromArray(['one']);
        $second = WordList::fromArray(['one', 'two', 'three']);

        $result = $wordListCoverageComparator->oneWayWordListsCompare($first, $second);

        $this->assertSame(1.0, $result);
    }

    public function testReversedOneWayWordListCompare()
    {
        $wordListCoverageComparator = new FullCoverageWordListComparator;

        $first = WordList::fromArray(['one', 'two', 'three', 'four']);
        $second = WordList::fromArray(['one']);

        $result = $wordListCoverageComparator->oneWayWordListsCompare($first, $second);

        $this->assertSame(0.25, $result);
    }

    public function testTwoWayWordListCompare()
    {
        $wordListCoverageComparator = new FullCoverageWordListComparator;

        $first = WordList::fromArray(['one', 'five', 'two', 'six', 'nine', 'two']);
        $second = WordList::fromArray(['one', 'two', 'three', 'four']);

        $result = $wordListCoverageComparator->twoWayWordListsCompare($first, $second);

        $this->assertSame(0.5, $result);
    }

    public function testTwoWayWordListCompareWithNoDifferences()
    {
        $wordListCoverageComparator = new FullCoverageWordListComparator;

        $first = WordList::fromArray(['one']);
        $second = WordList::fromArray(['one']);

        $result = $wordListCoverageComparator->twoWayWordListsCompare($first, $second);

        $this->assertSame(1.0, $result);
    }
}
