<?php
namespace mfmbarber\BetterData\Data;
use mfmbarber\BetterData\Data\AbstractData;
/**
  * ArrayData Class
  * Handles Array Data
  *
  * @package    BetterData
  * @author     Matt Barber <mfmbarber@gmail.com>
 **/
class ArrayData extends AbstractData
{

    /**
     * Call the parent constructor, then setup the base fields
     *
     * @param array     $fields     The data field keys
     * @param array     $data       The data to analyse
     *
     * @return void
    **/
    public function __construct(array $fields, array $data)
    {
        parent::__construct();
        $this->fields = $fields;
        $this->data = $data;
    }

    /**
     * Returns a row from the array of data stored in the property
     *
     * @return \Generator
    **/
    public function getRow() : \Generator
    {
        foreach ($this->data as $row)
        {
            yield array_combine($this->fields, $row);
        }
    }

    /**
     * Reset the array pointer to the beginning of the array
     *
     * @return void
    **/
    public function reset() : void
    {
        reset($this->data);
    }

}
