<?php

include 'vendor/autoload.php';
use mfmbarber\Profiler\ArrayProfiler;

$profiler = new ArrayProfiler();

$n = 0;
for ($i = 0; $i < 1000; $i++) {
    if ($i % 3 === 0) {
        $n += $i;
    }
}

print_r($profiler->getData());
unset($profiler);
