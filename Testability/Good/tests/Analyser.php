<?php
namespace mfmbarber\BetterData\Tests;
use PHPUnit\Framework\TestCase;
use mfmbarber\BetterData\Analyser;
use mfmbarber\BetterData\Data\AbstractData;

class AnalyserTest extends TestCase
{
    /**
     * Test that variance works as expected given a set of values
     * @return void
    **/
    public function testVarianceWorksAsExpected()
    {
        /**
         * A Pseudo generator for our mock
         *
         * @return Generator
        **/
        function generator() : \Generator {
            foreach ([10, 10, 11, 10] as $i) {
                yield ['a' => $i];
            }
        }
        // Create a stub for the AbstractData class.
        $stub = $this->createMock(AbstractData::class);
        // Configure the stub.
        $stub->method('isField')->willReturn(true);
        $stub->method('getRow')
            ->will(
                $this->onConsecutiveCalls(
                    generator(),
                    generator(),
                    generator(),
                    generator()
                )
            );
        $analyser = new Analyser($stub);
        $this->assertEquals(0.24999999999999986, $analyser->variance('a'));

    }
}
