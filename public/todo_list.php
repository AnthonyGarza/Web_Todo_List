<!DOCTYPE html>
<html>
<head>
</head>
	<title>TODO List</title>
	<?php
	define('FILENAME', 'data/todo.txt');

	$filename = 'data/list.txt';
	$items = array();

	function open_file()
	{
	    $filename = 'data/list.txt';
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
	?>
<body>
	<?php
		var_dump($_GET);
		var_dump($_POST);
    ?>
	<h1>TODO List</h1>
	<ul>
		<?php
		// loads TODO list items from a file
		$items = open_file();

        // Add TODO items to list and Save to file
        if (!empty($_POST)) {
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
</body>
</html>