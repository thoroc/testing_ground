<?php

namespace Absolvent\FuzzyText\Tests;

use PHPUnit_Framework_TestCase;

class PatternResourceCorrectnessTest extends PHPUnit_Framework_TestCase
{
    public function patternListProvider()
    {
        $ret = [];

        $globPattern = sprintf('%s/../Resources/pattern/*txt', __DIR__);
        foreach (glob($globPattern) as $file) {
            foreach (file($file) as $line) {
                $ret[] = [$file, trim($line)];
            }
        }

        return $ret;
    }

    /**
     * @dataProvider patternListProvider
     */
    public function testPatternCorrectness($file, $pattern)
    {
        $this->assertTrue(false !== preg_match($pattern, 'foo'));
    }
}
