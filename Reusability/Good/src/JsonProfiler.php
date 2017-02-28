<?php
namespace mfmbarber\Profiler;
/**
  * Json Profiler
  * Json Profiler stores the data for each tick as a json structure
  *
  * @package    Profiler
  * @author     Matt Barber <mfmbarber@gmail.com>
 **/
class JsonProfiler extends AbstractProfiler {

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
     * Return the data array of json encoded time / memory readings as a
     * json string
     *
     * @return string
    **/
    public function getData()
    {
        return json_encode($this->data, JSON_PRETTY_PRINT);
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
        $this->data[] = json_encode(
            [
                'time' => $time,
                'memory' => $memory
            ],
            JSON_PRETTY_PRINT
        );
    }
}
