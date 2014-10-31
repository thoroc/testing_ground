<?php

namespace Absolvent\FuzzyText\Tests;

use Absolvent\FuzzyText\WordList;
use PHPUnit_Framework_TestCase;

class WordListTest extends PHPUnit_Framework_TestCase
{
    public function testCountingWords()
    {
        $wordList = new WordList;

        $wordList->addWord('foo');
        $wordList->addWord('foo');
        $wordList->addWord('bar');
        $wordList->addWord('baz');
        $wordList->addWord('foo');

        $this->assertCount(5, $wordList);
    }

    public function testCreatingEmptyWordListAndInsertingRandomProperWords()
    {
        $wordList = new WordList;

        $wordList->addWord('foo');
        $wordList->addWord('foo');
        $wordList->addWord('bar');
        $wordList->addWord('baz');

        $this->assertTrue($wordList->hasWord('foo'));
        $this->assertTrue($wordList->hasWord('bar'));
        $this->assertTrue($wordList->hasWord('baz'));

        $this->assertFalse($wordList->hasWord('fooz'));
    }

    public function testCreatingEmptyWordListAndAssertCorrectWordsOrder()
    {
        $wordList = new WordList;

        $wordList->addWord('foo');
        $wordList->addWord('foo');
        $wordList->addWord('bar');
        $wordList->addWord('baz');
        $wordList->addWord('foo');

        $words = [];
        foreach ($wordList as $word) {
            $words[] = $word;
        }

        $this->assertSame(['foo', 'foo', 'bar', 'baz', 'foo'], $words);
    }

    public function testCreatingEmptyWordListAndCountingParticularWordOccurences()
    {
        $wordList = new WordList;

        $wordList->addWord('foo');
        $wordList->addWord('foo');
        $wordList->addWord('bar');
        $wordList->addWord('baz');
        $wordList->addWord('foo');

        $this->assertSame(3, $wordList->countWordOccurences('foo'));
        $this->assertSame(1, $wordList->countWordOccurences('bar'));
        $this->assertSame(1, $wordList->countWordOccurences('baz'));
        $this->assertSame(0, $wordList->countWordOccurences('fooz'));
    }

    public function testCreatingWordListFromArrayOfSplittablePhrases()
    {
        $input = ['foo bar booz', 'gooz wooz'];

        $wordList = WordList::fromArray($input);

        $this->assertSame($input, iterator_to_array($wordList));
    }

    public function testCreatingWordListManuallyFromSplittablePhrases()
    {
        $wordList = new WordList;

        $wordList->addWord('foo bar booz');
        $wordList->addWord('gooz wooz');

        $correct = ['foo bar booz', 'gooz wooz'];

        $this->assertSame($correct, iterator_to_array($wordList));
    }

    public function testCheckingNegativeWordListCoverage()
    {
        $first = new WordList;

        $first->addWord('foo');
        $first->addWord('foo');
        $first->addWord('bar');
        $first->addWord('baz');
        $first->addWord('foo');

        $second = new WordList;

        $second->addWord('baz');
        $second->addWord('foo');
        $second->addWord('foo');

        $this->assertFalse($first->isCoveredByWordList($second));
    }

    public function testCheckingWordListCoverage()
    {
        $first = new WordList;

        $first->addWord('baz');
        $first->addWord('foo');
        $first->addWord('foo');

        $second = new WordList;

        $second->addWord('foo');
        $second->addWord('foo');
        $second->addWord('bar');
        $second->addWord('baz');
        $second->addWord('foo');

        $this->assertTrue($first->isCoveredByWordList($second));
    }

    public function testCheckingTotalWordListCoverage()
    {
        $first = new WordList;

        $first->addWord('foo');
        $first->addWord('foo');
        $first->addWord('bar');
        $first->addWord('baz');
        $first->addWord('foo');

        $second = new WordList;

        $second->addWord('baz');
        $second->addWord('foo');
        $second->addWord('bar');
        $second->addWord('foo');
        $second->addWord('foo');

        $this->assertTrue($first->isCoveredByWordList($second));
    }

    public function testFindingLongestWord()
    {
        $wordList = new WordList;

        $wordList->addWord('a');
        $wordList->addWord('bb');
        $wordList->addWord('c');
        $wordList->addWord('ddd');
        $wordList->addWord('eeee');
        $wordList->addWord('f');

        $this->assertsame('eeee', $wordList->getLongestWord());
    }
}
