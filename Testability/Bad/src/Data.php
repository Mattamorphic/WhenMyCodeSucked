<?php
namespace mfmbarber\BadData;
/**
  * Data Class
  * Handles CSV files
  *
  * @package    BadData
  * @author     Matt Barber <mfmbarber@gmail.com>
 **/
class Data {
    private $data;
    private $fields;

    public function __construct()
    {
        $this->data = [];
        $this->fields = null;
    }

    /**
     * Open the file given by filename and load the data into the object
     *
     * @param string    $filename   The name of the file including path
     *
     * @return void
    **/
    public function loadData(string $filename) : void
    {
        if (!file_exists($filename)) {
            throw new \InvalidArgumentException("$filename doesn't exist");
        }
        if (!is_readable($filename)) {
            throw new \InvalidArgumentException("$filename is not readable");
        }
        if (
            !in_array(
                \finfo::file($filename, FILEINFO_MIME_TYPE),
                [
                    'application/vnd.ms-excel',
                    'text/plain',
                    'text/csv',
                    'text/tsv'
                ]
            )
        ) {
            throw new \InvalidArgumentException("$filename is not a CSV file");
        }
        $fp = fopen($filename, 'rb');
        if ($fp) {
            while (false !== $line = fgetcsv($fp)) {
                if ($this->fields === null) {
                    $this->fields = $line;
                }
                $this->data[] = array_combine($this->fields, $line);
            }
        }
        fclose($fp);
    }

    /**
     * Return data using a generator - yielding each item of the array
     *
     * @return \Generator
    **/
    public function getRow() : \Generator
    {
        foreach ($this->data as $row) {
            yield $row;
        }
    }

    /**
     * Reset the array pointer for the data attribute
     *
     * @return void
    **/
    public function reset() : void
    {
        reset($this->data);
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
        return isset($this->fields) && in_array($field, $this->fields);
    }
}
