<?php
include("./classes/dbh.classes.php");
  switch($_POST['op']) {
    case 'megye':
		$result=new DbhQuery();
		$result->megye();
      break;
	  
    case 'helyszin':
		$result=new DbhQuery();
		$result->helyszin();
      break;
	  
    case 'torony':
		$result=new DbhQuery();
		$result->torony();
      break;
	  
    case 'info':
		$result=new DbhQuery();
		$result->info();
      break;
  }
?>
