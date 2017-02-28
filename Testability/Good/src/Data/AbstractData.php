<?php
namespace mfmbarber\BetterData\Data;
/**
  * Data Class
  * Specifies Data Abstraction
  *
  * @package    BetterData
  * @author     Matt Barber <mfmbarber@gmail.com>
 **/
abstract class AbstractData
{
    protected $fields;

    public function __construct()
    {
        $this->fields = null;
    }

    /**
     * Check to see if field is in the data
     *
     * @param string    $field  a field to look for
     *
     * @return bool
    **/
    public function isField(string $field) : bool
    {
        return $this->fields && in_array($field, $this->fields);
    }

    public abstract function getRow() : \Generator;
    public abstract function reset() : void;
}
