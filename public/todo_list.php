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

	function save_file($list, $file)
	{
	    $write = fopen($file, 'w');
	    $string = implode("\n", $list);
	    fwrite($write, $string . "\n");
	    fclose($write);
	    echo "The save was succesful.\n";
	}
	?>
<body>
	<?php
		var_dump($_GET);
		var_dump($_POST);
    ?>
	<h1>TODO List</h1>
	<ul>
		<!-- <li>Clean room</li>
		<li>Vacuum</li>
		<li>Wash Dishes</li>
		<li>Laundry</li>
		<li>Get groceries</li> -->

		<!-- Create an array from your sample todo list items. Use PHP to display the array items within the unordered list in your template and test in your browser -->
		<?php

		$new_items = open_file();
        foreach ($new_items as $item) {
            array_push($items, $item);
        }
	    foreach ($items as $item) {
		echo "<li>$item</li>\n";
	    }
	    ?>
	</ul>
	<h2>Enter TODO List Items Below</h2>
	<form method="POST">
		<p>
		    <label for="input_item">ENTER TODO LIST ITEM TO ADD</label>
	        <input id="input_item" name="input_item" type="text" placeholder="Input Item">
		</p>
		<p>
			<input type="submit" value="Submit">
		</p>
	</form>
</body>
</html>