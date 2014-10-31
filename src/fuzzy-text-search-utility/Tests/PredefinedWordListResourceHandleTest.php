<?php

namespace Absolvent\FuzzyText\Tests;

use Absolvent\FuzzyText\PredefinedWordListResourceHandle;
use PHPUnit_Framework_TestCase;

class PredefinedWordListResourceHandleTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return \Absolvent\FuzzyText\PredefinedWordListResourceHandle
     */
    private function getWordListResourceHandle()
    {
        return new PredefinedWordListResourceHandle;
    }

    /**
     * @return array
     */
    public function patternListNameProvider()
    {
        return [
            [ 'addresses_and_location_indicators' ],
            [ 'ambiguous_and_generally_confusing_job_history' ],
            [ 'emoticons_ideographs_and_such' ],
            [ 'facebook_extravagance' ],
            [ 'messy_text_formatting' ],
        ];
    }

    /**
     * @dataProvider patternListNameProvider
     */
    public function testLoadPatternList($patternListName)
    {
        $patternList = PredefinedWordListResourceHandle::loadPatternList($patternListName);

        $this->assertTrue(is_array($patternList));
        $this->assertNotEmpty($patternList);
    }

    public function testLoadNonExistentPatternList()
    {
        $this->setExpectedException('RuntimeException');

        PredefinedWordListResourceHandle::loadPatternList('foo');
    }
}
