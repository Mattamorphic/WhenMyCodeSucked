<?php
/**
 * PHP 7 implementation of BinarySearch on a sorted array of items
 *
 * @param mixed     $item   Search item (must be comparable with <=>)
 * @param array     $arr    The array to search
 * @param int       $low    The low index of the array subset
 * @param int       $high   The high index of the array subset
 *
 * @return ?int
**/
function binarySearch($item, array $arr, int $low = 0, int $high = null) : ?int {
    // On first iteration, preflight checks
    if ($high === null) {
        $high = count($arr);
        if ($high === 0) {
            throw new \Exception('The search array is empty');
        }
        if ($high === 1) {
            return ($item === $arr[0]) ? 0 : null;
        }
    }
    $mid = intdiv($low + $high, 2);
    if ($low >= $high) {
        return null;
    }
    if ($item === $arr[$mid]) {
        return $mid;
    }
    // set the low and high bounds for the recursive call
    list($low, $high) = ($item < $arr[$mid]) ? [$low, $mid] : [$mid + 1, $high];
    return binarySearch($item, $arr, $low, $high);
}

echo binarySearch(11, [0,1,3,5,7,11,13,17,19,23]);
