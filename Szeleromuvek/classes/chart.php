<?php
header('Content-Type: application/json');
include("dbh.classes.php");
$result=new DbhQuery();
$result->chart();
?>




