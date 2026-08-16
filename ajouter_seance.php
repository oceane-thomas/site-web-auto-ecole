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
    if (empty($_POST['date'])) {
        echo "Il faut entrer une date";
    } elseif (empty($_POST['effmax'])) {
        echo "Il faut entrer un nombre maximum d'inscrits";
    } elseif (empty($_POST['menuChoixTheme'])) {
        echo "Il faut sélectionner un thème";
    } else {
        $dateseance = $_POST['date'];
        if ($dateseance < $date) {
            echo "On ne peut pas créer une séance dans le passé";
        } else {

            //verification type date
            $new_date = explode("-", $dateseance);
            if (empty($new_date[2]) || empty($new_date[1]) || empty($new_date[0])) {
                echo "Ce n'est pas une date";
            } else {
                if (!checkdate($new_date[1], $new_date[2], $new_date[0])) {
                    echo "Ce n'est pas une date";
                } else {

                    //verification de l effectif
                    $effmax = $_POST["effmax"];
                    if (mb_strlen($effmax) > 11) {
                        echo "L'effectif maximal doit faire moins de 12 caractères";
                    } else {
                        if (!is_numeric($effmax)) {
                            echo "L'effectif maximal doit être un nombre";
                        } else {
                            $theme_associe = $_POST["menuChoixTheme"];

                            echo "<br> la date saisie est : $dateseance";
                            echo "<br> l'effectif saisi est : $effmax";
                            echo "<br> le thème saisi est : $theme_associe";

                            $query = "insert into seances values (NULL, " . "'$dateseance'" . ", " . "'$effmax'" . ", " . "'$theme_associe'" . ")";

                            /* TEST SI LA SEANCE EXISTE DEJA*/
                            $comparaison = "select * from seances where idtheme='$theme_associe' and DateSeance ='$dateseance' ";
                            $comp = mysqli_query($connect, $comparaison);
                            $count = mysqli_num_rows($comp);
                            //utile pour deboguer
                            //echo "<br>$comparaison<br>";
                            //if (!$comp)
                            //{
                            //echo "<br>pas bon  ".mysqli_error($connect);
                            //};
                            if ($count !== 0) {
                                echo "<br>Il existe déjà une séance avec ce thème et ce jour";
                            } else {
                                $result = mysqli_query($connect, $query);
                                echo "<br>La séance a bien été enregistrée";
                                //utile pour deboguer
                                //echo "<br>$query<br>"; 
                                //if (!$result)
                                //{
                                //echo "<br>pas bon  ".mysqli_error($connect);
                            }
                        };
                    };
                };
            };
        };
    };
    mysqli_close($connect);
    ?>

</body>

</html>