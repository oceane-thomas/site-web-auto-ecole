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

    $result = mysqli_query($connect, "SELECT * FROM eleves");
    //utile pour deboguer
    //if (!$result)
    //{
    //echo "<br>pas bon  ".mysqli_error($connect);

    /* FORMULAIRE*/
    echo "<form method='post' action='consulter_eleve.php'>";
    echo "<label for='ChoixEleve'>Choix de l'élève : <BR></label>";
    echo "<select name='ChoixEleve' id='ChoixEleve' size='4' required/>";
    while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
        echo "<option value='$row[0]'> $row[1] $row[2]</option>";
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