<?php
header('HTTP/1.0 200 OK'); 
header('Content-Disposition: attachment; filename=test.csv'); 
header('Content-Transfer-Encoding: binary'); 
header('Accept-Ranges: bytes'); 
header('Content-Type: application/x-rar-compressed'); 
readfile("test.csv");
?>