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
		$new_items = open_file();
        foreach ($new_items as $item) {
            array_push($items, $item);
        }

        // Add TODO items to list and Save to file
        if (!empty($_POST)) {
        $items[] = "{$_POST['input_item']}";
		save_file($items, $filename);
    	}

    	// displays items
	    foreach ($items as $item) {
		echo "<li>$item</li>\n";
	    }
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