<?php

namespace Absolvent\FuzzyText;

use DomainException;
use InvalidArgumentException;
use Traversable;

class WordListNormalizer implements WordListNormalizerInterface
{
    /**
     * @param string $word
     * @return array
     */
    private function normalizeWord($word)
    {
        $word = preg_replace('/[^\p{L}]+/u', ' ', $word);
        $word = preg_split('/\s+/', trim($word));
        $word = array_filter($word, function ($wordChunk) {
            // TODO check if keyword is an abbreviation (all caps) - if so,
            // allow keyword to pass
            return strlen($wordChunk) > 1;
        });

        return array_unique($word);
    }

    /**
     * @param mixed $wordList
     * @param float $threshold parameter between 0 and 1
     * @return \Absolvent\FuzzyText\WordListInterface
     */
    public function normalizeWordList($wordList, $threshold = self::DEFAULT_WORD_LIST_THRESHOLD)
    {
        $wordList = WordList::fromAnything($wordList);

        $normalizedWordList = new WordList;
        foreach ($wordList as $word) {
            $word = $this->normalizeWord($word);
            $normalizedWordList->addWord($word);
        }

        return $normalizedWordList;
    }
}
