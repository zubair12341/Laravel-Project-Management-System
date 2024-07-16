<?php
if (isset($_POST['file'])) {
    $file = '../uploads/' . str_replace(array('/', '\\'), '', $_POST['file'] . '.txt');
	
    if(file_exists($file))
		unlink($file);
}