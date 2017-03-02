<?php

/**
 *
 *  ......Other code.....
 *
**/


/**
 * Tick function to update the data object with the latest memory & time usage
 *
 * @param object    $data  The data object to update
 *
 * @return void
**/
function tick($data) : void {
    $data->memory = (memory_get_usage() / 1024 / 1024) - $GLOBALS['startMemory'];
    $data->time = microtime(true) - $GLOBALS['startTime'];
}

// Set our reference and globals
$startTime = microtime(true);
$startMemory = memory_get_usage() / 1024 / 1024;
$data = new \stdClass;
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
echo "Took {$data->time} seconds, and used {$data->memory}mb";


/**
 *
 *  ......Other code.....
 *
**/
