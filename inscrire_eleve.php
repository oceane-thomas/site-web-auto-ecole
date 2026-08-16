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
    if (empty($_POST['menuChoixEleve'])) {
        echo "Il faut choisir un élève";
    } elseif (empty($_POST['menuChoixSeance'])) {
        echo "Il faut choisir une séance";
    } else {
        $eleve = $_POST['menuChoixEleve'];
        $seance = $_POST["menuChoixSeance"];

        /* VERIFICATIONS DE LA DATE DE LA SEANCE */
        $infoseance = "select DateSeance,EffMax from seances where idseance='$seance'";
        $resultseance = mysqli_query($connect, $infoseance);
        //utile pour deboguer
        //echo "<br>$infoseance<br>"; 
        //if (!$resultseance)
        //{echo "<br>pas bon  ".mysqli_error($connect);}
        $row = mysqli_fetch_row($resultseance);
        if ($row[0] < $date) {
            echo "On ne peut pas inscrire un élève à une séance dans le passé";
        } else {

            /* VERIFICATIONS DE L INSCRIPTION DE L ELEVE */
            $comparaison = "select * from inscription where idseance='$seance' and ideleve ='$eleve' ";
            $comp = mysqli_query($connect, $comparaison);
            $count = mysqli_num_rows($comp);
            //utile pour deboguer
            //echo "<br>$comparaison<br>";
            //if (!$comp)
            //{echo "<br>pas bon  ".mysqli_error($connect);};
            if ($count !== 0) {
                echo "L'élève est déjà inscrit";
            } else {

                /* VERIFICATIONS DE L EFFECTIF */
                $effectif = "select * from inscription where idseance='$seance'";
                $resulteff = mysqli_query($connect, $effectif);
                $count = mysqli_num_rows($resulteff);
                //utile pour deboguer
                //echo "<br>$effectif<br>";
                //if (!$resulteff)
                //{
                //echo "<br>pas bon  ".mysqli_error($connect);
                //};
                if ($count >= $row[1]) {
                    echo "L'effectif maximum est déjà atteint";
                } else {
                    $query = "insert into inscription (`idseance`, `ideleve`,`note`) values ('$seance','$eleve',null)";
                    $result = mysqli_query($connect, $query);
                    //utile pour deboguer
                    //echo "<br>$query<br>"; 
                    //if (!$result)
                    //{
                    //echo "<br>pas bon  ".mysqli_error($connect);
                    echo "L'élève a bien été inscrit";
                }
            };
        };
    };
    mysqli_close($connect);
    ?>

</body>

</html>