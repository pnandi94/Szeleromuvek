<?php
include ("./classes/tornyok.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Torony adatbázis</title>
</head>
<body>
    <?= $result ?>
    <h1>Tornyok:</h1>
    <?= $tabla ?>
    <br>
    <h2>Módosítás / Beszúrás</h2>
    <form method="post">
    Id: <input type="text" name="id"><br><br>
    Darab: <input type="text" name="db" maxlength="3"> Teljesítmény: <input type="text" name="teljesitmeny" maxlength="5"><br><br>
    Telepítés éve: <input type="text" name="kezdev" maxlength="4"> Helyszín id: <input type="text" name="helyszinid"><br><br>
    <input type="submit" value = "Küldés">
    </form>
</body>
</html>
