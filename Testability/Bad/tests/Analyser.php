<?php
namespace mfmbarber\BadData\Tests;

use PHPUnit\Framework\TestCase;
use mfmbarber\BadData\Analyser;
use mfmbarber\BadData\Data;

class AnalyserTest extends TestCase
{
    /**
     * Test that variance works as expected given a set of values
     * @return void
    **/
    public function testVarianceWorksAsExpected()
    {

        $analyser = new Analyser('tests/testFile.csv');
        $this->assertEquals(0.24999999999999986, $analyser->variance('a'));

    }
}
