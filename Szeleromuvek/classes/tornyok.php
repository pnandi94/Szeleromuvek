<?php
//$url = "http://localhost/feladat/web2/szerver.php";
$url = "http://localhost/Szeleromuvek/rest/server.php";
$result = "";
if(isset($_POST['id']))
{
  // Felesleges szóközök eldobása
  $_POST['id'] = trim($_POST['id']);
  $_POST['db'] = trim($_POST['db']);
  $_POST['teljesitmeny'] = trim($_POST['teljesitmeny']);
  $_POST['kezdev'] = trim($_POST['kezdev']);
  $_POST['helyszinid'] = trim($_POST['helyszinid']);
  
  // Ha nincs id és megadtak minden adatot, akkor beszúrás
  if($_POST['id'] == "" && $_POST['db'] != "" && $_POST['teljesitmeny'] != "" && $_POST['kezdev'] != "" && $_POST['helyszinid'] != "")
  {
      $data = Array("db" => $_POST["db"], "teljesitmeny" => $_POST["teljesitmeny"], "kezdev" => $_POST["kezdev"], "helyszinid" => $_POST["helyszinid"]);
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $result = curl_exec($ch);
      curl_close($ch);
  }
  
  // Ha nincs id de nem adtak meg minden adatot
  elseif($_POST['id'] == "")
  {
    $result = "Hiba: Hiányos adatok!";
  }
  
  // Ha van id, amely >= 1, és megadták legalább az egyik adatot, akkor módosítás
  elseif($_POST['id'] >= 1 && ($_POST['db'] != "" || $_POST['teljesitmeny'] != "" || $_POST['kezdev'] != "" || $_POST['helyszinid'] != ""))
  {
      $data = Array("id" => $_POST["id"], "db" => $_POST["db"], "teljesitmeny" => $_POST["teljesitmeny"], "kezdev" => $_POST["kezdev"], "helyszinid" => $_POST["helyszinid"]);
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $result = curl_exec($ch);
      curl_close($ch);
  }
  
  // Ha van id, amely >=1, de nem adtak meg legalább az egyik adatot
  elseif($_POST['id'] >= 1)
  {
      $data = Array("id" => $_POST["id"]);
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $result = curl_exec($ch);
      curl_close($ch);
  }
  
  // Ha van id, de rossz az id, akkor a hiba kiírása
  else
  {
    echo "Hiba: Rossz azonosító (Id): ".$_POST['id']."<br>";
  }
}

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$tabla = curl_exec($ch);
curl_close($ch);

?>