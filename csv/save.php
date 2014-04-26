<?php
try{
$fp = fopen('test.csv', 'w');
$values = $_POST['value'];
foreach ($values as $fields) {
    fputcsv($fp, $fields);
}

fclose($fp);
echo "сохранено";
}
catch(Error $e){
echo "не удалось сохранить";
}
?>