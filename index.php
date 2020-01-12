<?php
session_start();
require_once("Highscore.php");

$maxTries = 15;
$min = 1;
$max = 100;
$won = false;

if (empty($_SESSION['tries'])) {
    $_SESSION['tries'] = 1;
}

if (isset($_POST['alias'])) {
    $_SESSION['alias'] = $_POST['alias'];
    $_SESSION['gameHasStarted'] = true;
}

if (isset($_POST['cancel'])) {
    session_destroy();
    unset($_SESSION['alias'], $_SESSION['gameHasStarted']);
}

if (isset($_POST['alias'])
    || (
        isset($_SESSION['gameHasStarted'])
        && $_SESSION['gameHasStarted']
    )) {

    if (empty($_SESSION['starttime'])) {
        $_SESSION['randomNumber'] = \mt_rand($min, $max);
        $_SESSION['starttime'] = microtime(true);
        echo '<div>Die Zeit läuft ab Jetzt</div>';
    }

    if ($_SESSION['tries'] > $maxTries) {
        echo '<div>Maximale Versuche erreicht du Dummie</div>';
        echo '<div>Du hast ' . ((int)microtime(true) - (int)$_SESSION['starttime'])  . ' Sekunden gebraucht.</div>';
        $alias = $_SESSION['alias'];
        $_SESSION['tries'] = 1;
        $_SESSION['alias'] = $alias;

        echo '<form action="index.php" method="post">';
        echo '<div>' . $_SESSION['alias'] . ' willst du es nochmal versuchen ?</div>';
        echo '<input type="submit">';
        echo '</form>';
        $won = true;
        session_destroy();
    } else {
        if (isset($_POST['tipp'])
            && isset($_SESSION['randomNumber'])
        ) {
            if ($_POST['tipp'] == $_SESSION['randomNumber']) {
                echo '<div>Gratuliere du hast es Geschafft beim ' . $_SESSION['tries'] . ' versuch.</div>';
                echo '<div>Du hast ' . ((int)microtime(true) - (int)$_SESSION['starttime'])  . ' Sekunden gebraucht.</div>';
                $_SESSION['seconds'] = (int)microtime(true) - (int)$_SESSION['starttime'];
                Highscore::updateHighscore();
                $alias = $_SESSION['alias'];
                //session_destroy();
                $_SESSION['tries'] = 1;
                $_SESSION['alias'] = $alias;
                $won = true;

                echo '<form action="index.php" method="post">';
                echo '<div>' . $_SESSION['alias'] . ' willst du es nochmal versuchen ?</div>';
                echo '<input type="submit">';
                echo '</form>';

                Highscore::outputHighscore();

                unset($_SESSION['starttime'], $_SESSION['seconds']);

            } elseif ($_POST['tipp'] > $_SESSION['randomNumber']) {
                echo '<div>Tiefer</div>';
                echo '<div>Du hast ' . ((int)microtime(true) - (int)$_SESSION['starttime'])  . ' Sekunden gebraucht.</div>';
            } else {
                echo '<div>Hoeher</div>';
                echo '<div>Du hast ' . ((int)microtime(true) - (int)$_SESSION['starttime'])  . ' Sekunden gebraucht.</div>';
            }
        }
    }

    if (!$won) {
        echo '<form action="index.php" method="post">';
        echo '<div>' . $_SESSION['alias'] . ' Bitte gib deinen ' . $_SESSION['tries'] .' Tipp ab.</div>';
        echo '<input type="number" name="tipp" placeholder="Dein tipp">';
        echo '<input type="submit">';
        echo '</form>';

        echo '<form action="index.php" method="post">';
        echo '<div>' . $_SESSION['alias'] . ' Willst du abbrechen ?</div>';
        echo '<input type="submit" name="cancel">';
        echo '</form>';

        $_SESSION['tries']++;
    }

} else {
    echo '<h1>Wilkommen zum Tippspiel</h1>';
    echo '<h2>Das Ziel ist es eine Zahl zwischen 1 und 100 zu erraten.</h2>';
    echo '<form action="index.php" method="post">
            <input type="text" name="alias" placeholder="Dein Name">
            <input type="submit">
          </form>';

    echo '<h3>Hier ist der Highscore</h3>';

    Highscore::outputHighscore();
}
