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

    /* VERIFICATIONS COTE SERVEUR*/
    if (empty($_POST['theme'])) {
        echo "Il faut entrer un thème";
    } elseif (empty($_POST['descriptif'])) {
        echo "Il faut entrer un descriptif du thème";
    } else {
        $theme = mysqli_real_escape_string($connect, $_POST["theme"]);
        if (mb_strlen($theme) > 31) {
            echo "Le thème doit faire maximum 30 caractères";
        } else {
            echo "<br> le nom du thème saisi est : $theme";
            $supprime = 0;
            $descriptif = mysqli_real_escape_string($connect, $_POST["descriptif"]);
            echo "<br> le descriptif du thème saisi est : $descriptif";

            $query = "insert into themes values (NULL, " . "'$theme'" . "," . "'$supprime'" . "," . "'$descriptif'" . ")";
            //utile pour deboguer
            //echo "<br>$query<br>";

            /* TEST SI LE THEME EXISTE DEJA*/
            $comparaison = "select nom from themes where nom='$theme'";
            $comp = mysqli_query($connect, $comparaison);
            //utile pour deboguer
            //echo "<br>$comparaison<br>";
            //if (!$comp)
            //{
            //echo "<br>pas bon  ".mysqli_error($connect);
            //}
            $count = mysqli_num_rows($comp);
            if ($count !== 0) {
                echo "<br>Le thème existe déjà";
            } else {

                $result = mysqli_query($connect, $query);
                echo "<br>Le théme a bien été enregistré";
                //utile pour deboguer
                //if (!$result)
                //{
                //echo "<br>pas bon  ".mysqli_error($connect);
            }
        };
    };
    mysqli_close($connect);
    ?>

</body>

</html>