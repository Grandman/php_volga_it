<?php 
require 'Mandrill.php';
	$id = $_POST['id'];
	try {
    $mandrill = new Mandrill('3xGDzd_VFDw4tlUbMzOf5Q');
    $result = $mandrill->messages->content($id);
    echo $result['html'];
	} catch(Mandrill_Error $e) {
    echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
   	die();
}