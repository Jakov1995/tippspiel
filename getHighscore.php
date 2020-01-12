<?php
require_once("db.inc.php");

$connector = new SQLConnector();
$conn = $connector->getVerbindung();
$sql = "select Alias, Sekunden, Tippzahl from highscores;";
$result = mysqli_query($conn, $sql);

//prüfen ob null zurück kommt und alle Zeilen als Objekt in das Array geben
$arr = array();

if ($result != null) {
    while ($obj = $result->fetch_object()) {

        $array = array('alias' => $obj->Alias, 'sekunden' => $obj->Sekunden, 'tippzahl' => $obj->Tippzahl);

        $arr[] = $array;
    }
}

$_SESSION['highscore'] = $arr;
mysqli_close($conn);