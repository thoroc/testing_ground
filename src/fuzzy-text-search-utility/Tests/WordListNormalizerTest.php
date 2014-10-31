<?php

namespace Absolvent\FuzzyText\Tests;

use Absolvent\FuzzyText\WordList;
use Absolvent\FuzzyText\WordListNormalizer;
use PHPUnit_Framework_TestCase;

class WordListNormalizerTest extends PHPUnit_Framework_TestCase
{
    public function testCreatingEmptyWordListNormalizerAndInsertingRandomProperWords()
    {
        $wordListNormalizer = new WordListNormalizer;

        $wordList = $wordListNormalizer->normalizeWordList('Hello, world!');

        $this->assertInstanceOf('Absolvent\FuzzyText\WordList', $wordList);
        $this->assertSame(['Hello', 'world'], iterator_to_array($wordList));
    }
}
