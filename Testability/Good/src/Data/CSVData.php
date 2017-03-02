<?php
namespace mfmbarber\BetterData\Data;
use mfmbarber\BetterData\Data\AbstractData;
/**
  * CSVData Class
  * Handles CSV files
  *
  * @package    BetterData
  * @author     Matt Barber <mfmbarber@gmail.com>
 **/
class CSVData extends AbstractData
{
    private $fp;

    /**
     * As this is reading from a file set the file pointer property to null
     *
     * @return void
    **/
    public function __construct()
    {
        $this->fp = null;
        parent::__construct();
    }

    /**
     * Upon all references to this variable being removed
     * make sure the file pointer is closed
     *
     * @return void
    **/
    public function __destruct()
    {
        if ($this->fp) {
            fclose($this->fp);
        }
    }

    /**
     * Set the file pointer on the object to the file given in filename
     *
     * @param string    $filename   The name of the file
     *
     * @return void
    **/
    public function open(string $filename) : void
    {
        $this->close();
        $this->validateFile($filename);
        $this->fp = fopen($filename, 'rb');
        if (!$this->fp) {
            throw new \InvalidArgumentException("couldn't open $filename");
        }
    }

    /**
     * Get a row from the CSVFile
     *
     * @return ?\Generator
    **/
    public function getRow() : ?\Generator
    {
        if (!$this->fp) {
            return void;
        }
        while (false !== ($line = fgetcsv($this->fp))) {
            if (!$this->fields) {
                $this->fields = $line;
            }
            yield array_combine($this->fields, $line);
        }
    }

    /**
     * Reset the file pointer to the beginning if the file is open
     *
     * @return void
    **/
    public function reset() : void
    {
        if ($this->fp) {
            reset($this->fp);
        }
    }

    /**
     * Close the file pointer if it's open
     *
     * @return void
    **/
    private function close() : void
    {
        if ($this->fp) {
            fclose($this->fp);
        }
    }

    /**
     * Overall validation function for files
     *
     * @param string    $filename   The file to test
     *
     * @return void
    **/
    private function validateFile(string $filename) : void
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
    }

}
