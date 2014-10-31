<?php

namespace Absolvent\FuzzyText;

use ArrayIterator;

class WordList implements WordListInterface
{
    /**
     * @param array $wordsByOrder
     */
    private $wordsByOrder = [];

    /**
     * @param array $wordsByCount
     */
    private $wordsByCount = [];

    /**
     * @param mixed $wordList
     * @return DomainException
     */
    private static function createConstructFailureException($wordList)
    {
        return new DomainException(sprintf('Unable to convert "%s" type to "%s".', gettype($wordList), __CLASS__));
    }

    /**
     * @param string $word
     * @return void
     */
    public function addWord($word)
    {
        if (is_string($word)) {
            if (!isset($this->wordsByCount[$word])) {
                $this->wordsByCount[$word] = 0;
            }
            $this->wordsByCount[$word] += 1;
            $this->wordsByOrder[] = $word;
        } else {
            $this->merge(static::fromAnything($word));
        }
    }

    /**
     * @return integer
     */
    public function count()
    {
        return array_sum($this->wordsByCount);
    }

    /**
     * @param string $word
     * @return integer
     */
    public function countWordOccurences($word)
    {
        return isset($this->wordsByCount[$word]) ? intval($this->wordsByCount[$word]) : 0;
    }

    /**
     * @return ArrayIterator
     */
    public function getIterator()
    {
        return new ArrayIterator($this->wordsByOrder);
    }

    /**
     * @return string
     */
    public function getLongestWord()
    {
        $longestWordItself = null;
        $longestWordLength = 0;

        foreach ($this->wordsByCount as $word => $wordCount) {
            $wordLength = strlen($word);
            if ($wordLength > $longestWordLength) {
                $longestWordItself = $word;
                $longestWordLength = $wordLength;
            }
        }

        return $longestWordItself;
    }

    /**
     * @param string $word
     * @return boolean
     */
    public function hasWord($word)
    {
        return isset($this->wordsByCount[$word]);
    }

    /**
     * @param \Absolvent\FuzzyText\WordListInterface $otherWordList
     * @return void
     */
    public function isCoveredByWordList(WordListInterface $otherWordList)
    {
        foreach ($this->wordsByCount as $word => $wordCount) {
            if ($otherWordList->countWordOccurences($word) < $wordCount) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param WordListInterface $otherWordList
     * @return void
     */
    public function merge(WordListInterface $otherWordList)
    {
        foreach ($otherWordList as $otherWord) {
            $this->addWord($otherWord);
        }
    }

    /**
     * @param mixed $anything
     * @return \Absolvent\FuzzyText\WordListInterface
     * @throws DomainException
     */
    public static function fromAnything($anything)
    {
        if ($anything instanceof self) {
            return $anything;
        }

        switch (true) {
            case is_array($anything): return static::fromArray($anything);
            case is_bool($anything): return static::fromBoolean($anything);
            case is_float($anything): return static::fromFloat($anything);
            case is_int($anything): return static::fromInteger($anything);
            case is_object($anything): return static::fromObject($anything);
            case is_string($anything): return static::fromString($anything);
        }

        throw static::createConstructFailureException($anything);
    }

    /**
     * @param array $input
     * @return \Absolvent\FuzzyText\WordListInterface
     */
    public static function fromArray(array $input)
    {
        $wordList = new static;
        if (empty($input)) {
            return $wordList;
        }

        foreach ($input as $inputChunk) {
            if (is_string($inputChunk)) {
                $wordList->addWord($inputChunk);
            } else {
                $wordList->merge(self::fromAnything($inputChunk));
            }
        }

        return $wordList;
    }

    /**
     * @param boolean $input
     * @return \Absolvent\FuzzyText\WordListInterface
     */
    public static function fromBoolean($input)
    {
        return static::fromString(($input ? 'true' : 'false'), $threshold);
    }

    /**
     * @param number $input
     * @return \Absolvent\FuzzyText\WordListInterface
     */
    public static function fromFloat($input)
    {
        return static::fromString(sprintf('%F', $input), $threshold);
    }

    /**
     * @param number $input
     * @return \Absolvent\FuzzyText\WordListInterface
     */
    public static function fromInteger($input)
    {
        return static::fromString(sprintf('%d', $input), $threshold);
    }

    /**
     * @param object $input
     * @return \Absolvent\FuzzyText\WordListInterface
     */
    public static function fromObject($input)
    {
        if (method_exists($input, '__toString')) {
            return static::fromString(strval($input), $thresold);
        }

        if ($input instanceof Traversable) {
            $r = [];
            foreach ($input as $key => $value) {
                $r[$key] = $value;
            }

            return static::fromArray($r, $threshold);
        }

        throw static::createConstructFailureException($input, $threshold);
    }

    /**
     * @param string $input
     * @return \Absolvent\FuzzyText\WordListInterface
     */
    public static function fromString($input)
    {
        $wordList = new static;
        $wordList->addWord($input);

        return $wordList;
    }
}
