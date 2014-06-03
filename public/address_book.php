<?

$filename = "data/address_book.csv";

// $address_book = [
//     ['The White House', '1600 Pennsylvania Avenue NW', 'Washington', 'DC', '20500'],
//     ['Marvel Comics', 'P.O. Box 1527', 'Long Island City', 'NY', '11101'],
//     ['LucasArts', 'P.O. Box 29901', 'San Francisco', 'CA', '94129-0901']
// ];

$address_book = [];

function csv_output($address_book, $filename){
	if (is_writable($filename)) {
		$handle = fopen($filename, 'w');
		foreach ($address_book as $fields) {
			fputcsv($handle, $fields);
		}
		fclose($handle);
	}
}

function load_csv($filename) {
	// if (is_readable($filename) && filesize($filename) > 0){
		$handle = fopen($filename, 'r');
		$address_book = [];
		while(!feof($handle)) {
			$row = fgetcsv($handle);
    		if(is_array($row)) {
    			$address_book[] = $row;
    		}
    	}
    // }
    fclose($handle); 
    return $address_book;
} 

$address_book = load_csv($filename);


print_r($address_book);

csv_output($address_book, $filename);

if (!empty($_POST['name']) && !empty($_POST['address']) && !empty($_POST['city']) && !empty($_POST['state']) && !empty($_POST['zip'])) {
	
	$new_address = [];
	
	$new_address['name'] = $_POST['name'];
	$new_address['address'] = $_POST['address'];
	$new_address['city'] = $_POST['city'];
	$new_address['state'] = $_POST['state'];
	$new_address['zip'] = $_POST['zip'];
	$new_address['phone'] = $_POST['phone'];

	array_push($address_book, $new_address);
	csv_output($address_book, $filename);

} else {
	foreach ($_POST as $key => $value) {
		if (empty($value)){
			echo "<h3> The " . ucfirst($key) .  " field is empty, please input a valid " . ucfirst($key) . "</h3>";
		}
	}
}



?>
<html>
<head>
	<title></title>
</head>
<body>
	<!-- from to receive user information -->
	<table>
		<tr>
			<th>Name</th>
			<th>Address</th>
			<th>City</th>
			<th>State</th>
			<th>Zip</th>
			<th>Phone</th>
		</tr>
		<? foreach ($address_book as $fields) : ?>
		<tr>
				<? foreach ($fields as $value) : ?>
				<td><?= $value ?></td>
				<? endforeach; ?>
				<!-- <td><a href=""></a></td> -->
		</tr>
		<? endforeach; ?>
	</table>
	<form method="POST" action="/address_book.php">
        <p>
            <label for="name">Name:</label>
            <input id="name" name="name" method="post" type="text" placeholder="required">
        </p>
        <p>
            <label for="address">Address:</label>
            <input id="address" name="address" type="text" placeholder="required">
        </p>
        <p>
            <label for="city">City:</label>
            <input id="city" name="city" type="text" placeholder="required">
        </p>
        <p>
            <label for="state">State:</label>
            <input id="state" name="state" type="text" placeholder="required">
        </p>
        <p>
            <label for="zip">Zip:</label>
            <input id="zip" name="zip" type="text" placeholder="required">
        </p>
        <p>
            <label for="phone">Phone:</label>
            <input id="phone" name="phone" type="text" placeholder="***-***-***">
        </p>
        <p>
            <input type="submit" value="submit">
        </p>
    </form>
    
</body>
</html>