<?php

$eredmeny = "";
try {
	$dbh = new PDO('mysql:host=localhost;dbname=szeleromuvek', 'root', '',
				  array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
	$dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
	switch($_SERVER['REQUEST_METHOD']) {
		case "GET":
				$sql = "SELECT torony.id, db, teljesitmeny, kezdev, helyszin.nev FROM torony INNER JOIN helyszin ON helyszinid=helyszin.id";     
				$sth = $dbh->query($sql);
				$eredmeny .= "<table style=\"border-collapse: collapse;\"><tr><th>Id</th><th>Darab</th><th>Teljesítmény (MW)</th><th>Telepítés éve</th><th>Helyszín</th><th></th></tr>";
				while($row = $sth->fetch(PDO::FETCH_ASSOC)) {
					$eredmeny .= "<tr>";
					foreach($row as $column)
						$eredmeny .= "<td style=\"border: 1px solid black; padding: 3px;\">".$column."</td>";
					$eredmeny .= "</tr>";
				}
				$eredmeny .= "</table>";
			break;
		case "POST":
				$sql = "insert into torony INNER JOIN helyszin ON helyszinid=helyszin.id values (0, :db, :teljesitmeny, :kezdev, :nev)";
				$sth = $dbh->prepare($sql);
				$count = $sth->execute(Array(":db"=>$_POST["db"], ":teljesitmeny"=>$_POST["teljesitmeny"], ":kezdev"=>$_POST["kezdev"], ":nev"=>$_POST["nev"]));
				$newid = $dbh->lastInsertId();
				$eredmeny .= $count." beszúrt sor: ".$newid;
			break;
		case "PUT":
				$data = array();
				$incoming = file_get_contents("php://input");
				parse_str($incoming, $data);
				$modositando = "id=id"; $params = Array(":id"=>$data["id"]);
				if($data['db'] != "") {$modositando .= ", db = :db"; $params[":db"] = $data["db"];}
				if($data['teljesitmeny'] != "") {$modositando .= ", teljesitmeny = :teljesitmeny"; $params[":teljesitmeny"] = $data["teljesitmeny"];}
				if($data['kezdev'] != "") {$modositando .= ", kezdev = :kezdev"; $params[":kezdev"] = $data["kezdev"];}
				if($data['nev'] != "") {$modositando .= ", nev = :nev"; $params[":nev"] = $data["nev"];}
				$sql = "update torony set ".$modositando." where id=:id";
				$sth = $dbh->prepare($sql);
				$count = $sth->execute($params);
				$eredmeny .= $count." módositott sor. Azonosítója:".$data["id"];
			break;
		case "DELETE":
				$data = array();
				$incoming = file_get_contents("php://input");
				parse_str($incoming, $data);
				$sql = "delete from torony where id=:id";
				$sth = $dbh->prepare($sql);
				$count = $sth->execute(Array(":id" => $data["id"]));
				$eredmeny .= $count." sor törölve. Azonosítója:".$data["id"];
			break;
	}
}
catch (PDOException $e) {
	$eredmeny = $e->getMessage();
}
echo $eredmeny;

?>