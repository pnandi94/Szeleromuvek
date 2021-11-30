<?php
class Dbh{
	
	protected function connect(){
		try{
			$username="root";
			$password="";
			$host="localhost";
			$dbName="szeleromuvek";
			$dbh=new PDO('mysql:host=localhost;dbname=szeleromuvek', $username, $password, array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
			//$dbh = new PDO('mysql:host=localhost;dbname=hatoslotto', 'root', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
			//$dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
			return $dbh;
		}
		catch (PDOException $e){
			print "Error!: " . $e->getMessage(). "<br/>";
			die();
		}
	}
}
class DbhQuery extends Dbh{
	public function hirek($newsCount){
		$count=$newsCount;
		$select='SELECT * from news ORDER BY postdate DESC LIMIT '.$count;
		$result = $this->connect()->prepare($select);
		$result->execute();
		if ($result==null){
			echo "Nincs több hír!";
		} else {
			while($row=$result->fetch()){
				echo "<p>";
				echo "<h3>".$row['title']." - ".$row['author']." - ".$row['postdate']."</h3>";
				echo $row['content'];
				echo "</p>";
			}
		}
	}
	
	public function feltolt(){
		if($_POST['content']!=null and $_POST['title']!=null){
			$sqlInsert = "insert into news(id, content, title, author, postdate)
                          values(0, :content, :title, :author, :postdate)";
			$stmt = $this->connect()->prepare($sqlInsert); 
			$author=$_SESSION['uid'];
			$postdate=date("Y-m-d");
			$stmt->execute(array(':content' => $_POST['content'], ':title' => $_POST['title'],
							   ':author' => $author, ':postdate' => $postdate));
			echo "<br>Sikeres feltöltés";
		} else{
			echo "<br>Hiányzó cím vagy tartalom";
		}
		return 0;
	}
	
	public function chart(){
		$eredmeny = array();
		try {
			$select="select kezdev, sum(teljesitmeny) as telj from torony group by kezdev order by kezdev";
			$result = $this->connect()->prepare($select);
			$result->execute();
			while($row = $result->fetch(PDO::FETCH_ASSOC)) {
				  $eredmeny[]=$row;
			}
		}
		catch(PDOException $e) {
		}
		echo json_encode($eredmeny);
	}
	
	public function megye(){
      $eredmeny = array("lista" => array());
      try {
		$select="select id, nev from megye";
		$result = $this->connect()->prepare($select);
		$result->execute();
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
              $eredmeny["lista"][] = array("id" => $row['id'], "nev" => $row['nev']);
        }
      }
      catch(PDOException $e) {
      }
      echo json_encode($eredmeny);
	}
	
	public function helyszin(){
      $eredmeny = array("lista" => array());
      try {
		$select="select id, nev from helyszin where megyeid = :id";
		$result = $this->connect()->prepare($select);
		$result->execute(Array(":id" => $_POST["id"]));
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
              $eredmeny["lista"][] = array("id" => $row['id'], "nev" => $row['nev']);
        }
      }
      catch(PDOException $e) {
      }
      echo json_encode($eredmeny);
	}
	
	public function torony(){
	  $eredmeny = array("lista" => array());
	  try {
		$select="select id, kezdev from torony where helyszinid = :id";
		$result = $this->connect()->prepare($select);
		$result->execute(Array(":id" => $_POST["id"]));
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
              $eredmeny["lista"][] = array("id" => $row['id'], "kezdev" => $row['kezdev']);
        }
      }
      catch(PDOException $e) {
      }
      echo json_encode($eredmeny);			  
	}
	
	public function info(){
      $eredmeny = array("db" => "", "teljesitmeny" => "");
      try {
		$select="select db, teljesitmeny from torony where id = :id";
		$result = $this->connect()->prepare($select);
		$result->execute(Array(":id" => $_POST["id"]));
        if($row = $result->fetch(PDO::FETCH_ASSOC)) {
              $eredmeny = array("db" => $row['db'], "teljesitmeny" => $row['teljesitmeny']);
        }
      }
      catch(PDOException $e) {
      }
      echo json_encode($eredmeny);
	}
	
}	
?>