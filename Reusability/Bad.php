<?php

/**
 *
 *  ......Other code.....
 *
**/


/**
 * Tick function to update the data object with the latest memory & time usage
 *
 * @param object    &$data  The data object to update
 *
 * @return void
**/
function tick(\stdClass $data) : void {
    $data->memory = memory_get_usage() / 1024 / 1024 - $GLOBALS['memory'];
    $data->time = microtime(true) - $GLOBALS['time'];
}

// Set our reference and globals
$data = new \stdClass;
$time = microtime(true);
$memory = memory_get_usage() / 1024 / 1024;
// register the function for each tick
register_tick_function('tick', $data);
declare(ticks=1);

// some arbitary code to test
$n = 0;
for ($i = 0; $i < 1000; $i++) {
    if ($i % 3 === 0) {
        $n += $i;
    }
}
// unregister tick
unregister_tick_function('tick');
// print the result...
print_r($data);


/**
 *
 *  ......Other code.....
 *
**/
