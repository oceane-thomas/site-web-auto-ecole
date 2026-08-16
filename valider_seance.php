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

    /* VERIFICATIONS COTE SERVEUR */
    if (empty($_POST['idseance'])) {
        echo "Il faut choisir une séance";
    } else {
        $idseance = $_POST["idseance"];

        $query = "select eleves.ideleve, eleves.nom, eleves.prenom, inscription.note from eleves inner join inscription on eleves.ideleve=inscription.ideleve 
    where inscription.idseance=$idseance";
        $result = mysqli_query($connect, $query);
        //utile pour deboguer
        //echo "<br>$query<br>"; 
        //if (!$result)
        //{
        //echo "<br>pas bon  ".mysqli_error($connect);

        /* VERIFICATIONS ELEVES INSCRITS */
        if (mysqli_num_rows($result) == 0) {
            echo "<p> Aucun élève n'est inscrit à cette séance</p>";
        } else {

            /* FORMULAIRE */
            echo "<form method='post' action='noter_eleve.php'>";
            echo "<table border ='1'>";
            echo "<caption> Notes des élèves </caption>";
            echo "<tr><th> Nom </th> <th> Prénom </th> <th> Nombre de fautes </th></tr>";
            while ($row = mysqli_fetch_row($result)) {
                echo "<tr>";
                $ideleve = $row[0];
                $nom = $row[1];
                $prenom = $row[2];
                $note = $row[3];
                echo "<td> $nom </td>";
                echo "<td> $prenom </td>";
                echo "<td>";
                echo "<input type='number' name='$ideleve' value ='$note' min='0' max='40'>";
            }
            echo "</td>";
            echo "</tr>";
            echo "</table>";
            echo "<br>";
            echo "<INPUT type='hidden' value='$idseance' name='idseance'>";
            echo "<INPUT type='submit' value='Enregistrer'>";
            echo "</FORM>";
        };
    };

    mysqli_close($connect);
    ?>

</body>

</html>