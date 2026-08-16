<html>

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
    if (empty($_POST['radio'])) {
        echo "Il faut sélectionner une option";
    } elseif (empty($_POST['nom'])) {
        echo "Il faut entrer un nom";
    } elseif (empty($_POST['prenom'])) {
        echo "Il faut entrer un prénom";
    } elseif (empty($_POST['date'])) {
        echo "Il faut entrer une date de naissance";
    } else {
        $choix = $_POST['radio'];
        $date_naissance = $_POST["date"];
        $prenom = $_POST["prenom"];
        $nom = $_POST["nom"];
        if ($choix == 'non') {
            echo "L'enregistrement est abandonné";
        } else {

            $query = "insert into eleves values (NULL, " . "'$nom'" . ", " . "'$prenom'" . ", " . "'$date_naissance'" . ", " . "'$date'" . ")";
            $result = mysqli_query($connect, $query);
            //utile pour deboguer
            //echo "<br>$query<br>"; 
            //if (!$result)
            //{
            //echo "<br>pas bon  ".mysqli_error($connect);
            echo "L'élève a été ajouté";
        }
    };
    mysqli_close($connect);
    ?>

</body>

</html>