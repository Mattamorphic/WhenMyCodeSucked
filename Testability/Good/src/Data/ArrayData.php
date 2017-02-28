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

    public function __construct(array $fields, array $data)
    {
        parent::__construct();
        $this->fields = $fields;
        $this->data = $data;
    }

    /**
     *
    **/
    public function getRow() : \Generator
    {
        foreach ($this->data as $row)
        {
            yield array_combine($this->fields, $row);
        }
    }

    /**
     * 
    **/
    public function reset() : void
    {
        reset($this->data);
    }

}
