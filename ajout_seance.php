<!DOCTYPE html>
<html lang="en" dir="ltr">

    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style.css" type="text/css">
    </head>

    <body>

        <h1 class="form-title">Ajouter une séance</h1>
        <?php

        $dbhost = 'tuxa.sme.utc';
        $dbuser = 'nf92a069';
        $dbpass = 'wfIx9cOiP5JS';
        $dbname = 'nf92a069';
        $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die('Error connecting to mysql');
        mysqli_set_charset($connect, 'utf8');

        $result = mysqli_query($connect, "SELECT * FROM themes where supprime=0"); //selection des themes actifs
        //utile pour deboguer
        //if (!$result)
        //{echo "<br>pas bon  ".mysqli_error($connect);};

        /* FORMULAIRE*/
        echo "<form method='post' action='ajouter_seance.php'>";
        echo "<label for='date'>Date de la séance : </label>";
        echo "<input id='date' type='date' name='date' required/>";
        echo "<BR>";
        echo "<label for='effmax'>Nombre maximum d'inscriptions possibles : </label>";
        echo "<input id='effmax' type='number' name='effmax' maxlength='11' required/>";
        echo "<BR>";
        echo "<label for='menuChoixTheme'>Thème de la séance : <BR></label>";
            echo "<select id='menuChoixTheme' name='menuChoixTheme' size='4' required/>";
        while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
            echo "<option value='$row[0]'> $row[1]</option>";
        }
        echo "</select>";
        echo "<BR>";
        echo "<BR>";
        echo "<INPUT type='submit' value='Enregistrer la séance'>";
        echo "</FORM>";

        mysqli_close($connect);

        ?>

    </body>

</html>