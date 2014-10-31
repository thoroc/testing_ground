<?php

namespace Absolvent\FuzzyText\Tests;

use Absolvent\FuzzyText\Matcher;
use Absolvent\FuzzyText\OverallSimilarityWordListComparator;
use Absolvent\FuzzyText\SelfInclusionWordListAnalyzer;
use Absolvent\FuzzyText\Sieve;
use Absolvent\FuzzyText\WordListNormalizer;
use PHPUnit_Framework_TestCase;

abstract class AbstractMatcherTest extends PHPUnit_Framework_TestCase
{
    abstract public function testFilteringWordList();

    abstract public function testFindingOneClosestWordList();
}
