<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css" type="text/css">
</head>

<body>

    <?php

    date_default_timezone_set('Europe/Paris');
    $date = date("Y-m-d");
    $dbhost = 'tuxa.sme.utc';
    $dbuser = 'nf92a069';
    $dbpass = 'wfIx9cOiP5JS';
    $dbname = 'nf92a069';
    $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die('Error connecting to mysql');
    mysqli_set_charset($connect, 'utf8');

    if (empty($_POST['idseance'])) {
        echo "Il faut choisir une séance";
    } else {
        $idseance = $_POST['idseance'];

        $query = "select eleves.ideleve from eleves inner join inscription on eleves.ideleve=inscription.ideleve
        where inscription.idseance=$idseance";

        $result = mysqli_query($connect, $query);
        //utile pour deboguer
        //echo "<br>$query<br>"; 
        //if (!$result)
        //{
        //echo "<br>pas bon  ".mysqli_error($connect);

        /* MISE A JOUR DES NOTES */
        while ($row = mysqli_fetch_row($result)) {
            if (!empty($_POST[$row[0]]) || $_POST[$row[0]] == "0") { //si on a une note
                $note = $_POST[$row[0]];
                if ($note < "0" || $note > "40" || !is_numeric($note)) {
                    echo "Le nombre de fautes doit être un nombre compris entre 0 et 40";
                    exit();
                } else {
                    $query = "UPDATE inscription SET note = $note  WHERE ideleve = $row[0] and idseance = $idseance";
                    $changer_note = mysqli_query($connect, $query);
                    //utile pour deboguer
                    //echo "<br>$query<br>"; 
                    //if (!$changer_note)
                    //{
                    //echo "<br>pas bon  ".mysqli_error($connect);
                };
            };
        };
        echo "Le nomre de fautes a bien été enregistré <br>"; 
    };
    mysqli_close($connect);
    ?>

</body>

</html>