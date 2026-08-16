<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css" type="text/css">
</head>

<body>

    <h1 class="form-title">Inscrire un élève</h1>
    <?php
    date_default_timezone_set('Europe/Paris');
    $date = date("Y-m-d");
    $dbhost = 'tuxa.sme.utc';
    $dbuser = 'nf92a069';
    $dbpass = 'wfIx9cOiP5JS';
    $dbname = 'nf92a069';
    $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die('Error connecting to mysql');
    mysqli_set_charset($connect, 'utf8');

    $query = "SELECT * FROM eleves";
    $result = mysqli_query($connect, $query);
    //utile pour deboguer
    //if (!$result)
    //{
    //echo "<br>pas bon  ".mysqli_error($connect);

    /* FORMULAIRE*/
    echo "<form method='post' action='inscrire_eleve.php'>";
    echo "<label for='menuChoixEleve'>Choisir un élève<br></label>";
    echo "<select name='menuChoixEleve' id='menuChoixEleve' size='4' required/>";
    while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
        echo "<option value='$row[0]'> $row[1] $row[2] : $row[3] ($row[0])</option>";
    } //pour pouvoir distinguer les homonymes
    echo "</select>";
    echo "<BR>";
    echo "<BR>";

    $query = "SELECT idseance, DateSeance, nom FROM seances JOIN themes on seances.Idtheme=themes.idtheme where DateSeance>='$date' "; //seance dans le futur
    $result = mysqli_query($connect, $query);
    //utile pour deboguer
    //echo "<br>$query<br>";
    //if (!$result)
    //{
    //echo "<br>pas bon  ".mysqli_error($connect)};

    /* CHOIX DE LA SEANCE */
    echo "<label for='menuChoixSeance'>Choisir une séance<br></label>";
    echo "<select name='menuChoixSeance' id='menuChoixSeance' size='4' required/>";
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