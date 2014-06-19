<?

$addressBook = [];
$errorMessage = '';

require_once('classes/address_data_store.php');

$ads = new Filestore('data/address_book.csv');			// instantiates and assigning to variable
//$ads->filename = 'data/address_book.csv';	// passes $filename a parameter

$addressBook = $ads->read_csv();

if (!empty($_POST))
{
	// we must be trying to add a new address
	if (!empty($_POST['name']) && !empty($_POST['address']) && !empty($_POST['city']) && !empty($_POST['state']) && !empty($_POST['zip']))
	{
		// validation success & writes the value to the array, 1 key at a time
		$newAddress = [];

		$newAddress['name'] = $_POST['name'];
		$newAddress['address'] = $_POST['address'];
		$newAddress['city'] = $_POST['city'];
		$newAddress['state'] = $_POST['state'];
		$newAddress['zip'] = $_POST['zip'];
		if (empty($_POST['phone'])) {
			$newAddress['phone'] = 'N/A';
		} else {
			$newAddress['phone'] = $_POST['phone'];
		}
		
		
		// push onto address book
		$addressBook[] = $newAddress;

		// save the address book
		$ads->write_csv($addressBook);
	}
	else
	{
		// validation failed
		foreach ($_POST as $key => $value) {
			if (empty($value)){
				echo "<h3> The " . ucfirst($key) .  " field was left empty, please input a valid " . ucfirst($key) . "</h3>";
			}
		}
	}
}

// Verify there were uploaded files and no errors
if (count($_FILES) > 0 && $_FILES['file1']['error'] == 0) {

    if ($_FILES['file1']["type"] != "text/csv") {
        echo "ERROR: file must be in text/csv!";
    } else {
        // Set the destination directory for uploads
        // Grab the filename from the uploaded file by using basename
        $upload_dir = '/vagrant/sites/codeup.dev/public/uploads/';
        $uploadFilename = basename($_FILES['file1']['name']);
        // Create the saved filename using the file's original name and our upload directory
        $saved_filename = $upload_dir . $uploadFilename;
        // Move the file from the temp location to our uploads directory
        move_uploaded_file($_FILES['file1']['tmp_name'], $saved_filename);

        // load the new todos
        // merge with existing list
        $upload = new AddressDataStore($saved_filename);
        $addresses_uploaded = $upload->read_csv();
        $addressBook = array_merge($addressBook, $addresses_uploaded);
        $ads->write_csv($addressBook);
    }
}

// Remove
if (isset($_GET['id'])) {
	$remove_index = $_GET['id'];
	unset($addressBook[$remove_index]);
	$ads->write_csv($addressBook);
	header('Location: /adress_book.php');
	exit(0);
}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Address Book</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
		<h1>Address Book</h1>
		<? if (!empty($errorMessage)) : ?>
			<p><?=$errorMessage;?></p>
		<? endif; ?>
		<p>
			<table>
				<tr>
					<th>Name</th>
					<th>Address</th>
					<th>City</th>
					<th>State</th>
					<th>Zip</th>
					<th>Phone</th>
					<th>Remove</th>
				</tr>
				<? foreach ($addressBook as $index => $row) : ?>

					<tr>
						<? foreach ($row as $column) : ?>
							<td><?=$column;?></td>

						<? endforeach; ?>
						<td><?= "<a href='?id=$index'>remove entry</a>"; ?></td>
					</tr>

				<? endforeach; ?>
			</table>
		</p>

		<p>
			<form action="address_book.php" method="POST">
				<p>
					<label for="name">Name</label>
					<input type="text" name="name" id="name" placeholder='required'>
				</p>
				<p>
					<label for="address">Address</label>
					<input type="text" name="address" id="address" placeholder='required'>
				</p>
				<p>
					<label for="city">City</label>
					<input type="text" name="city" id="city" placeholder='required'>
				</p>
				<p>
					<label for="state">State</label>
					<input type="text" name="state" id="state" placeholder='required'>
				</p>
				<p>
					<label for="zip">Zip</label>
					<input type="text" name="zip" id="zip" placeholder='required'>
				</p>
				<p>
					<label for="phone">Phone</label>
					<input type="text" name="phone" id="phone">
				</p>

				<!-- todo add the other fields -->

				<input type="submit">

			</form>
		</p>
		<h1>Upload a File:</h1>
		    <form method="POST" enctype="multipart/form-data" action="address_book.php">
			    <p>
			        <label for="file1"></label>
			        <input type="file" id="file1" name="file1">
			    </p>
			    <p>
			        <input type="submit" value="upload">
			    </p>
			</form>
	</body>
</html>
<? 
// destroy ads class/object
unset($ads);
?>