<?

require_once('classes/filestore.php');

class AddressDataStore extends Filestore{
    function __construct($filename) {       // __construct overrides parent
        $filename = strtolower($filename);  // converts filename to lower
        parent::__construct($filename);     // reinstates the functionality of parent __construct
    }
}

?>