<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css" type="text/css">
</head>

<body>

    <h1 class="form-title">Valider une séance</h1>
    <?php

    date_default_timezone_set('Europe/Paris');
    $date = date("Y-m-d");
    $dbhost = 'tuxa.sme.utc';
    $dbuser = 'nf92a069';
    $dbpass = 'wfIx9cOiP5JS';
    $dbname = 'nf92a069';
    $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die('Error connecting to mysql');
    mysqli_set_charset($connect, 'utf8');

    $result = mysqli_query($connect, "SELECT * FROM seances where DateSeance<'$date'");
    $query = "SELECT idseance, DateSeance, nom FROM seances JOIN themes on seances.Idtheme=themes.idtheme where DateSeance<'$date'";
    $result = mysqli_query($connect, $query);
    //utile pour deboguer
    //echo "<br>$query<br>"; 
    //if (!$result)
    //{
    //echo "<br>pas bon  ".mysqli_error($connect);

    /* FORMULAIRE*/
    echo "<form method='post' action='valider_seance.php'>";
    echo "<label for='idseance'>Choisir une séance<br></label>";
    echo "<select name='idseance' id='idseance' size='4' required/>";
    while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
        echo "<option value='$row[0]'> $row[1] : $row[2]</option>";
    }
    echo "</select>";
    echo "<BR>";
    echo "<BR>";
    echo "<INPUT type='submit' value='Enregistrer'>";
    echo "</FORM>";
    mysqli_close($connect);

    ?>

</body>

</html>