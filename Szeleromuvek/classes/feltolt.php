<?php
	include("dbh.classes.php");
	if(isset($_POST['title']) && isset($_POST['content'])){
		$result=new dbhQuery;
		$result->feltolt();
	}
?>
