<?php

namespace Absolvent\FuzzyText;

use RuntimeException;

class PredefinedWordListResourceHandle
{
    /**
     * @param string $name
     * @return string
     */
    private static function getWordListResourcePath($name)
    {
        return sprintf('%s/Resources/%s.txt', __DIR__, $name);
    }

    /**
     * @param string $name
     * @return string
     */
    private static function readWordListResource($name)
    {
        $resourcePath = static::getWordListResourcePath($name);
        if (!file_exists($resourcePath)) {
            throw new RuntimeException(sprintf("File '%s' does not exist.", $resourcePath));
        }

        return array_map('trim', file($resourcePath));
    }

    /**
     * @param string $name
     * @return string
     */
    public static function loadPatternList($name)
    {
        return static::readWordListResource(sprintf('pattern/%s', $name));
    }

    /**
     * @param string $name
     * @return string
     */
    public static function loadWordList($name)
    {
        return static::readWordListResource(sprintf('wordlist/%s', $name));
    }
}
