<?php

namespace Absolvent\FuzzyText;

use BadMethodCallException;

class Sieve implements SieveInterface, WordListAnalyzerAwareInterface, WordListNormalizerInterface, WordListNormalizerAwareInterface
{
    use WordListNormalizerAwareProxyTrait;

    /**
     * @var \Absolvent\FuzzyText\SieveInterface $previousSieve
     */
    private $previousSieve = null;

    /**
     * @var \Absolvent\FuzzyText\WordListAnalyzerInterface $wordListAnalyzer
     */
    private $wordListAnalyzer = null;

    /**
     * @param mixed $wordList
     * @return array
     * @throws BadMethodCallException
     */
    private function analyzeWordList($wordList)
    {
        if (!($this->wordListAnalyzer instanceof WordListAnalyzerInterface)) {
            throw new BadMethodCallException('Internal "WordListAnalyzer" is not set thus calling it is not possible.');
        }
        $wordList = $this->normalizeWordList($wordList);

        return $this->wordListAnalyzer->analyzeWordList($wordList);
    }

    /**
     * @param \Absolvent\FuzzyText\WordListAnalyzerInterface $wordListAnalyzer (optional) (default: null)
     * @param \Absolvent\FuzzyText\WordListNormalizerInterface $wordListNormalizer (optional) (default: null)
     * @param \Absolvent\FuzzyText\SieveInterface $previousSieve (optional) (default: null)
     */
    public function __construct(WordListAnalyzerInterface $wordListAnalyzer = null, WordListNormalizerInterface $wordListNormalizer = null, SieveInterface $previousSieve = null)
    {
        $this->setWordListAnalyzer($wordListAnalyzer);
        $this->setWordListNormalizer($wordListNormalizer);

        $this->setPreviousSieve($previousSieve);
    }

    /**
     * @param mixed $wordList
     * @param float $threshold parameter between 0 and 1
     * @param boolean $asArray whether to return response as array
     * @return array|WordListInterface
     */
    public function filterWordList($wordList, $threshold = SieveInterface::DEFAULT_LOWER_THRESHOLD, $asArray = true)
    {
        if ($this->previousSieve instanceof SieveInterface) {
            $wordList = $this->previousSieve->filterWordList($wordList, $threshold, $asArray);
        }

        $wordListAnalyzeResult = $this->analyzeWordList($wordList, $threshold);

        $response = [];
        foreach ($wordListAnalyzeResult as $word => $wordWeight) {
            if ($wordWeight > $threshold) {
                $response[] = $word;
            }
        }

        if ($asArray) {
            return $response;
        }

        return $this->normalizeWordList($response);
    }

    /**
     * @param array $wordLists
     * @param float $threshold parameter between 0 and 1
     * @param boolean $asArray whether to return response as array
     * @return array|WordListInterface
     */
    public function filterWordLists(array $wordLists, $threshold = SieveInterface::DEFAULT_LOWER_THRESHOLD, $asArray = true)
    {
        if ($this->previousSieve instanceof SieveInterface) {
            $wordList = $this->previousSieve->filterWordList($wordList, $threshold, $asArray);
        }

        $wordListAnalyzeResult = $this->analyzeWordList($wordList, $threshold);

        $response = [];
        foreach ($wordListAnalyzeResult as $word => $wordWeight) {
            if ($wordWeight > $threshold) {
                $response[] = $word;
            }
        }

        if ($asArray) {
            return $response;
        }

        return $this->normalizeWordList($response);
    }

    /**
     * @param \Absolvent\FuzzyText\WordListAnalyzerInterface $wordListAnalyzer (optional) (default: null)
     * @return WordListInterface
     */
    public function setPreviousSieve(SieveInterface $previousSieve = null)
    {
        $this->previousSieve = $previousSieve;
    }

    /**
     * @param \Absolvent\FuzzyText\WordListAnalyzerInterface $wordListAnalyzer (optional) (default: null)
     * @return WordListInterface
     */
    public function setWordListAnalyzer(WordListAnalyzerInterface $wordListAnalyzer = null)
    {
        $this->wordListAnalyzer = $wordListAnalyzer;
    }
}
