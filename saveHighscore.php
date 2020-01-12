<?php
require("db.inc.php");

$connector = new SQLConnector();
$conn = $connector->getVerbindung();
$sql = "insert into highscores (Alias, Sekunden, Tippzahl) values (?, ?, ?);";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sii", $_SESSION['alias'], $_SESSION['seconds'], $_SESSION['tries']);
$stmt->execute();

mysqli_close($conn);