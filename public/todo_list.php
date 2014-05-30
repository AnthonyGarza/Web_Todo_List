<!DOCTYPE html>
<html>

	<?php
		var_dump($_GET);
		var_dump($_POST);
    ?>

<head>
</head>
	<title>TODO List</title>
	<?php
	define('FILENAME', 'data/todo.txt');

	$filename = 'data/list.txt';
	$items = array();

	function open_file($filename = 'data/list.txt')
	{
	    // $filename = 'data/list.txt';
	    $filesize = filesize($filename);
	    $read = fopen($filename, 'r');
	    $list_string = trim(fread($read, $filesize));
	    $list = explode("\n", $list_string);
	    return $list;
	    fclose($read);
	}

	function save_file($list, $filename)
	{
		$filename = 'data/list.txt';
	    $write = fopen($filename, 'w');
	    $string = implode("\n", $list);
	    fwrite($write, $string . "\n");
	    fclose($write);
	}

	$items = open_file($filename);
	// Verify there were uploaded files and no errors
	if (count($_FILES) > 0 && $_FILES['file1']['error'] == 0) {
	    // Set the destination directory for uploads
	    $upload_dir = '/vagrant/sites/todo.dev/public/uploads/';
	    // Grab the filename from the uploaded file by using basename
	    $filename = basename($_FILES['file1']['name']);
	    // Create the saved filename using the file's original name and our upload directory
	    $saved_filename = $upload_dir . $filename;
	    // Move the file from the temp location to our uploads directory
	    move_uploaded_file($_FILES['file1']['tmp_name'], $saved_filename);

	    // upload file to existing TODO list
	    $uploadedItems = open_file($saved_filename);
	    // var_dump($uploadedItems);
		$items = array_merge($items, $uploadedItems);
		// var_dump($items);
	}

	// Check if we saved a file
	if (isset($saved_filename)) {
	    // If we did, show a link to the uploaded file
	    echo "<p>You can download your file <a href='/uploads/{$filename}'>here</a>.</p>";
	}
	save_file($items, $filename);

	?>

<body>

	<h1>TODO List</h1>
	<ul>
		<?php
		// loads TODO list items from a file
		$items = open_file();

        // Add TODO items to list and Save to file
        if (!empty($_POST['input_item'])) {
        	array_push($items, $_POST['input_item']);
    	}

    	// removes link to TODO item thet user clicks on to remove
    	elseif (isset($_GET['removeIndex'])) {
    		$removeIndex = $_GET['removeIndex'];
    		unset($items[$removeIndex]);
    	}

    	// displays items and provides indexed link to item
	    foreach ($items as $index => $item) {
		echo "<li>$item <a href=\"todo_list.php?removeIndex={$index}\">Remove item</a></li>\n";
	    }

	    // saves TODO list to file
	    save_file($items, $filename);

	    ?>
	</ul>

	<h2>Enter TODO List Items to Add Below</h2>

	<form method="POST">
		<p>
		    <label for="input_item">ENTER TODO LIST ITEM TO ADD:</label>
	        <input id="input_item" name="input_item" type="text" placeholder="Input Item">
		</p>
		<p>
			<input type="submit" value="Submit">
		</p>
	</form>


	<h1>Upload File</h1>

	<form method="POST" enctype="multipart/form-data">
	    <p>
	        <label for="file1">File to upload: </label>
	        <input type="file" id="file1" name="file1">
	    </p>
	    <p>
	        <input type="submit" value="Upload">
	    </p>
	</form>

</body>
</html>