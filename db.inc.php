<?php
class SQLConnector
{
    public function getVerbindung()
    {
        $mysqli = mysqli_connect('localhost', 'root', '', 'm133');
        $mysqli->set_charset("utf8");

        return $mysqli;
    }
}