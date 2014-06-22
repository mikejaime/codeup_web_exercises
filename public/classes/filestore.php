<?php

class Filestore {

    public $filename = '';
    public $is_csv = false;     // var for csv test

    function __construct($filename = '') 
    {
        // Sets $this->filename
        $this->filename = $filename; // sets filename passed to var filename
        if (substr($this->filename, -3) == 'csv'){
            $this->is_csv = true;
        }
    }

    public function read(){
        if($this->is_csv){
            return $this->read_csv();
        } else {
            return $this->read_lines();
        }
    }

    public function write($array){
        if($this->is_csv){
            $this->write_csv($array);
        } else {
            $this->write_lines($array);
        }
        
    }

    
    // Returns array of lines in $this->filename
    private function read_lines()
    {
        if (is_readable($this->filename) && filesize($this->filename) > 0){ 
        $filesize = filesize($this->filename);
        $handle = fopen($this->filename, "r");
        $file_contents = fread($handle, $filesize);
        $new_array = explode(PHP_EOL, $file_contents);
        fclose($handle); 
        return $new_array;
        }
    }


    // Writes each element of $array to a new line in $this->filename
    private function write_lines($array)
    {
        if (is_writeable($this->filename)){
        $new_string = implode(PHP_EOL, $array);
        $handle = fopen($this->filename, 'w');
        fwrite($handle, $new_string);
        fclose($handle);
        return;
        }
    }

    
    // Reads contents of csv $this->filename, returns an array
    private function read_csv()
    {
        // Code to read file $this->filename
        $addresses = [];

        // reads each line of CSV and adds row(s) to array
        $handle = fopen($this->filename, 'r');  // "$this->" allows us to utilize attributes within the class
        while (!feof($handle)) {                // feof: tests for end-of-file on a file pointer  
            $row = fgetcsv($handle);            // fgetcsv: parses lines and returns an array
            if (is_array($row)) {
                $addresses[] = $row;            // pushes each $row on $addresses array
            }
        }
        fclose($handle);
        return $addresses;
    }

    
    // Writes contents of $array to csv $this->filename
    private function write_csv($array)
    {
        if (is_writable($this->filename)) {
            $handle = fopen($this->filename, 'w');
            foreach ($array as $entry) {        // foreach $array as $entry
                fputcsv($handle, $entry);       // convert $entry nested array to a csv line, adding to file
            }
        fclose($handle);
        }
    }
}

?>