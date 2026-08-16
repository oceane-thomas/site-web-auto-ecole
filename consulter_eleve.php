<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css" type="text/css">
</head>

<body>

    <h1 class="form-title">Consulter les élèves</h1>
    <?php

    $dbhost = 'tuxa.sme.utc';
    $dbuser = 'nf92a069';
    $dbpass = 'wfIx9cOiP5JS';
    $dbname = 'nf92a069';
    $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die('Error connecting to mysql');
    mysqli_set_charset($connect, 'utf8');

    /* VERIFICATIONS COTE SERVEUR */
    if (empty($_POST['ChoixEleve'])) {
        echo "Il faut choisir un élève";
    } else {
        $ideleve = $_POST["ChoixEleve"];

        $result = mysqli_query($connect, "SELECT * FROM eleves where ideleve='$ideleve'");
        //utile pour deboguer
        //if (!$result)
        //{
        //echo "<br>pas bon  ".mysqli_error($connect);

        $row = mysqli_fetch_array($result, MYSQLI_NUM);

        /* AFFICHAGE TABLEAU */
        echo "<table border ='1'>";
        echo "<caption> Informations de l'élève </caption>";
        echo "<tr><th> Nom </th> <th> Prénom </th> <th> Date de naissance </th> <th> Date d'inscription </th></tr>";
        echo "<tr>";
        echo "<td> $row[1] </td>";
        echo "<td> $row[2] </td>";
        echo "<td> $row[3] </td>";
        echo "<td> $row[4] </td>";
        echo "</tr>";
        echo "</table>";
    };

    mysqli_close($connect);

    ?>

</body>

</html>