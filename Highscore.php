<?php
require_once("db.inc.php");

// @toDo: __construct missing research and add it

class Highscore extends SQLConnector
{
    public static function outputHighscore()
    {
        self::selectHighscore(10);

        $size = count($_SESSION['highscore']);

        echo '<table>';
        echo '<tr>
                    <td>Rang</td>
                    <td>Name</td>
                    <td>Sekunden</td>
                    <td>Tipps</td>
                  </tr>';

        for ($a = 0; $a < $size; $a++) {
            echo '<tr>
                    <td>' . ($a + 1) . '</td>
                    <td>' . $_SESSION['highscore'][$a]['alias'] . '</td>
                    <td>' . $_SESSION['highscore'][$a]['sekunden'] . '</td>
                    <td>' . $_SESSION['highscore'][$a]['tippzahl'] . '</td>
                  </tr>';
        }

        echo '</table>';
    }

    public static function selectHighscore(int $limit)
    {
        $conn = (new Highscore)->getVerbindung();

        $sql = "select Alias, Sekunden, Tippzahl from highscores order by Tippzahl, Sekunden limit " . $limit;
        $result = mysqli_query($conn, $sql);

        $arr = array();

        if ($result != null) {
            while ($obj = $result->fetch_object()) {

                $array = array('alias' => $obj->Alias, 'sekunden' => $obj->Sekunden, 'tippzahl' => $obj->Tippzahl);

                $arr[] = $array;
            }
        }

        $_SESSION['highscore'] = $arr;
        mysqli_close($conn);
    }

    public static function updateHighscore()
    {
        $conn = (new Highscore)->getVerbindung();

        $sql = "insert into highscores (Alias, Sekunden, Tippzahl) values (?, ?, ?);";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sii", $_SESSION['alias'], $_SESSION['seconds'], $_SESSION['tries']);
        $stmt->execute();

        mysqli_close($conn);
    }

}