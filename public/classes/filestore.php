<?php

class Filestore {

    public $filename = '';

    function __construct($file)
    {
        // Sets $this->filename
        $this->filename = $file;
    }

    /**
     * Returns array of lines in $this->filename
     */
    function read_lines()
    {

        if ( (is_readable($this->filename) && (filesize($this->filename) > 0))) {
            $handle = fopen($this->filename, 'r');
            $contents = trim(fread($handle, filesize($this->filename)));
            fclose($handle);
            //echo $contents;
            $arrayed = explode(PHP_EOL, $contents);
            return $arrayed;
        }//end of file found
        else {
            echo 'Error Reading File' . PHP_EOL;
            return FALSE;
        }//file not found

    }

    /**
     * Writes each element in $array to a new line in $this->filename
     */
    function write_lines($array)
    {

        if (is_writeable($this->filename)){
            $handle = fopen($this->filename, 'w');
            foreach ($array as $list_item) {
                fwrite($handle, $list_item . PHP_EOL);
            }//end of foreach
            fclose($handle);
            return TRUE;
        } //end of ovewrite ok
        else {
            return FALSE;
        } // end of else

    }

    /**
     * Reads contents of csv $this->filename, returns an array
     */
    function read_csv()
    {
        $handle = fopen($this->filename, 'r');

        while(!feof($handle)) {
            $row = fgetcsv($handle);
            if (is_array($row)) {
                $entries[] = $row;
            }
        }
        return $entries;
        fclose($handle);

    }

    /**
     * Writes contents of $array to csv $this->filename
     */
    function write_csv($array)
    {
        if (is_writable($this->filename)) {
            $handle = fopen($this->filename, 'w');
            foreach ($bigArray as $fields) {
                fputcsv($handle, $fields);
            }
            fclose($handle);
        }

    }

}