<?

class AddressDataStore {

    public $filename = '';

    public function __construct($placeholder)
    {
    	$this->filename = $placeholder;
    }

    public function readAddressBook()
    {
        // Code to read file $this->filename
        $addresses = [];

        // read each line of CSV and add rows to addresses array
        // todo
        $handle = fopen($this->filename, 'r');	// this alows us to utilize attributes within the class
        while (!feof($handle)) {				
        	$row = fgetcsv($handle);				// assigns
        	if (is_array($row)) {
        		$addresses[] = $row;
        	}
        }
        fclose($handle);
        return $addresses;
    }

    public function writeAddressBook($addresses) 
    {
        if (is_writable($this->filename)) {
			$handle = fopen($this->filename, 'w');
			foreach ($addresses as $entry) {		// foreach $array as $entry
				fputcsv($handle, $entry);				// convert $entry nested array to a csv line, adding to file
			}
		fclose($handle);
		}
    }

    public function __destruct()
    {
    	echo "Class dismissed!";
    }
}

?>