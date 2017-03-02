<?php
namespace mfmbarber\BetterData;
use mfmbarber\BetterData\Data\AbstractData;
/**
  * Analyser Class
  * Analyses instances of Data
  *
  * @package    BetterData
  * @author     Matt Barber <mfmbarber@gmail.com>
 **/
class Analyser
{
    private $data;

    public function __construct(AbstractData $data)
    {
        $this->data = $data;
    }

    /**
     * Algorithm to calculate variance of a data set
     * This online algorithm allows us to do this in a single pass in O(n) time
     *
     * @param string    $field  A field in the data set
     *
     * @return float
     *
    **/
    public function variance(string $field) : float
    {
        if (!$this->data->isField($field)) {
            throw new \InvalidArgumentException("$field doesn't exist in data");
        }

        $variance = 0;
        $mean = 0;
        foreach ($this->data->getRow() as $i => $row) {
            ++$i;
            $delta = $row[$field] - $mean;
            $mean += $delta / $i;
            $delta2 = $row[$field] - $mean;
            $variance += $delta * $delta2;
        }
        if ($i < 2) {
            return null;
        }
        return $variance / ($i - 1);
    }
}
