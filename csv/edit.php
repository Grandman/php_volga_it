<?php
$uploadfile="test.csv";
if (!move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
   die("Не удалось загрузить");
   }
   $row = 0;
if (($handle = fopen("test.csv", "r")) !== FALSE) {
echo "<form id=\"saveForm\" name=\"saveForm\" action=\"POST\" role=\"form\">
<table class=\"table\">";
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
		
		echo "<tr>";
        for ($c=0; $c < $num; $c++) {
            echo "<td><input type=\"text\" name=\"value[{$row}][{$c}]\" value=\"" . $data[$c] . "\"></td>";
        }
		echo "</tr>";
		$row++;
    }
	echo "</table>
	<button type=\"button\" id=\"save_button\" class=\"btn btn-primary\" onclick=\"saveFile()\">
		  Сохранить
		  </button></form>";
	}