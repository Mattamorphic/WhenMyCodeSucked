<?php
namespace mfmbarber\BadData;
/**
  * Analyser Class
  * Does analysis things
  *
  * @package    BadData
  * @author     Matt Barber <mfmbarber@gmail.com>
 **/
class Analyser
{
    private $data;

    public function __construct(string $filename)
    {
        $this->data = new Data();
        $this->data->loadData($filename);

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
            $delta = $row[$key] - $mean;
            $mean += $delta / $i;
            $delta2 = $row[$key] - $mean;
            $variance += $delta * $delta2;
        }
        if ($i < 2) {
            return null;
        }
        return $variance / ($i - 1);
    }
}
