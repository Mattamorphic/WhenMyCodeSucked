<?php
namespace mfmbarber\Profiler;
/**
  * Array Profiler
  * Array Profiler stores the data for each tick in an array
  *
  * @package    Profiler
  * @author     Matt Barber <mfmbarber@gmail.com>
 **/
class ArrayProfiler extends AbstractProfiler {

    /**
     * Initialise the data attribute to an empty array
     *
    **/
    public function __construct()
    {
        $this->data = [];
        parent::__construct();
    }

    /**
     * Return the data array of all time and memory recordings
     *
     * @return array
    **/
    public function getData() {
        return $this->data;
    }

    /**
     * On each tick, add the time and memory recordings to the
     * data attribute
     *
     * @param   int     $time   The time difference for the tick
     * @param   int     $memory The memory difference for the tick
     *
     * @return void
    **/
    public function addData(float $time, float $memory) : void {
        $this->data[] = [
            'time' => $time,
            'memory' => $memory
        ];
    }
}
