<?php
namespace mfmbarber\Profiler;
/**
  * Abstract Profiler
  * Profiler types extend from this
  *
  * @package    Profiler
  * @author     Matt Barber <mfmbarber@gmail.com>
 **/
abstract class AbstractProfiler {

    private $data;
    private $counter;

    protected $source;
    protected $initialMem;
    protected $initialTime;

    /**
     * Upon instantiating the profiler set the initial state, and register
     * the 'tick' function
     *
     * @param   DataInterface   $source     The source to send the data to
     *
    **/
    public function __construct(DataInterface $source = null)
    {
        if ($source !== null) {
            $this->source = $source;
        }
        $this->initialMem = $this->memoryAsMb();
        $this->initialTime = microtime(true);
        $this->counter = 0;
        declare(ticks = 1);;
        register_tick_function([$this, 'tick']);
    }

    /**
    * Upon there being no references to a particular object
    * or an object is explicitly unset - unregister the tick function
     *
    **/
    public function __destruct()
    {
        unregister_tick_function([$this, 'tick']);
    }


    /**
     * Tick is a method registered to run when each line of code is executed
     * after instantiation
     *
     * @return void
    **/
    public function tick() : void
    {
        ++$this->counter;
        $this->addData(
            microtime(true) - $this->initialTime,
            $this->memoryAsMb() - $this->initialMem
        );
    }

    /**
     * Returns a count of all times the tick is called
     *
     * @return int
    **/
    public function getCount() : int {
        return $this->counter;
    }

    /**
     * Return the current memory usage as megabytes
     *
     * @return float
    **/
    private function memoryAsMb() : float {
        return memory_get_usage() / 1024 / 1024;
    }

    /**
     * getData() from the Profiler
     *
     * @return mixed
    **/
    public abstract function getData();

    /**
     * addData to the data property on each tick
     *
     * @param int   $time       The time taken for the tick
     * @param int   $memory     The memory used for the tick
     *
     * @return void
    **/
    public abstract function addData(float $time, float $memory) : void;
}
