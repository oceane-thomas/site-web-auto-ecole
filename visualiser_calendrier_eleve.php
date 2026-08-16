<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css" type="text/css">
</head>

<body>

    <h1 class="form-title">Consulter les élèves</h1>
    <?php
    date_default_timezone_set('Europe/Paris');
    $date = date("Y-m-d");
    $dbhost = 'tuxa.sme.utc';
    $dbuser = 'nf92a069';
    $dbpass = 'wfIx9cOiP5JS';
    $dbname = 'nf92a069';
    $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die('Error connecting to mysql');
    mysqli_set_charset($connect, 'utf8'); //les données envoyées vers mysql sont encodées en UTF-8

    /* VERIFICATIONS COTE SERVEUR */
    if (empty($_POST['ChoixEleve'])) {
        echo "Il faut choisir un élève";
    } else {
        $ideleve = $_POST["ChoixEleve"];

        $query = "select inscription.idseance , DateSeance, themes.nom from eleves 
        join inscription on eleves.ideleve=inscription.ideleve 
        join seances on seances.idseance=inscription.idseance
        join themes on seances.Idtheme=themes.idtheme 
        where eleves.ideleve ='$ideleve' and DateSeance>'$date'";

        $result = mysqli_query($connect, $query);

        //utile pour deboguer
        //echo "<br>$query<br>"; 
        //if (!$result)
        //{
        //echo "<br>pas bon  ".mysqli_error($connect);

        /* VERIFICATIONS EXISTENCE DES SEANCES */
        $count = mysqli_num_rows($result);
        if ($count == "0") {
            echo "L'élève n'a aucune séance de prévue";
        } else {

            /* TABLEAU */
            echo "<table border ='1'>";
            echo "<caption> Calendrier </caption>";
            echo "<tr><th> Séances </th></tr>";
            while ($row = mysqli_fetch_row($result)) {
                echo "<tr><td> $row[1] : $row[2] </td></tr>";
            };
            echo "</table>";
        };
    };
    mysqli_close($connect);

    ?>

</body>

</html>