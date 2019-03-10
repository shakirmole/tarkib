<?
header('Content-type: application/csv');
header('Content-Disposition: attachment; filename='.$fname);

echo $output;
?>