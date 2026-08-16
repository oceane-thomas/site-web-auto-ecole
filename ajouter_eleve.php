<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css" type="text/css">
</head>

<body>
    <h1>Confirmation ajout d'élève</h1>
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
    if (empty($_POST['nom'])) {
        echo "Il faut entrer un nom";
    } elseif (empty($_POST['prenom'])) {
        echo "Il faut entrer un prénom";
    } elseif (empty($_POST['date'])) {
        echo "Il faut entrer une date de naissance";
    } else {
        $nom = mysqli_real_escape_string($connect, $_POST['nom']); // pour échapper les caractères spéciaux
        if (mb_strlen($nom) > 31) {
            echo "Le nom doit faire maximum 30 caractères";
        } else {
            echo "<br> le nom saisi est : $nom";
            $prenom = mysqli_real_escape_string($connect, $_POST['prenom']);
            if (mb_strlen($prenom) > 31) {
                echo "Le prenom doit faire maximum 30 caractères";
            } else {
                echo "<br> le prenom saisi est : $prenom";
                $date_naissance = $_POST["date"];
                if ($date_naissance > $date) //date de naissance dans le futur invalide
                {
                    echo "<br> Date de naissance invalide";
                } else {
                    $separe_date = explode("-", $date_naissance); //separation de la date en annee mois jour
                    if (empty($separe_date[2]) || empty($separe_date[1]) || empty($separe_date[0])) {
                        echo "<br> Ce n'est pas une date";
                    } else {
                        if (!checkdate($separe_date[1], $separe_date[2], $separe_date[0])) // Verification du type date
                        {
                            echo "<br> Ce n'est pas une date";
                        } else {
                            // verification que l annee de naissance ne soit pas il y a plus de 150 ans
                            $current_separe_date = explode("-", $date);
                            $current_year = $current_separe_date[0] - 150;
                            $annee_naissance = $separe_date[0];
                            if ($current_year > $annee_naissance) {
                                echo "<br> Trop vieux";
                            } else {
                                echo "<br> la date de naissance saisie est : $date_naissance";


                                $query = "insert into eleves values (NULL, " . "'$nom'" . ", " . "'$prenom'" . ", " . "'$date_naissance'" . ", " . "'$date'" . ")";


                                // On teste si l eleve existe deja
                                $comparaison = "select * from eleves where nom='$nom' and prenom ='$prenom' ";
                                $comp = mysqli_query($connect, $comparaison);
                                $count = mysqli_num_rows($comp);
                                //utile pour deboguer
                                //echo "<br>$comparaison<br>";
                                //if (!$comp)
                                //{
                                //echo "<br>pas bon  ".mysqli_error($connect);
                                //};

                                /* Formulaire si l eleve existe deja */
                                if ($count !== 0) {
                                    echo "<form method='post' action='valider_eleve.php'>";
                                    echo "L'élève existe déjà. Voulez-vous vraiment le rajouter ? <br>";
                                    echo "<label for='oui'>Oui</label>";
                                    echo "<input id='oui' type='radio' name='radio' value='oui' checked required/><br>";
                                    echo "<label for='non'>Non</label>";
                                    echo "<input id='non' type='radio' name='radio' value='non' required/><br>";
                                    echo "<input value='$nom' type='hidden' name='nom'>";
                                    echo "<input value='$prenom' type='hidden' name='prenom'>";
                                    echo "<input value='$date_naissance' type='hidden' name='date'>";
                                    echo "<input value='Valider' type='submit'>";
                                    echo "</form>";
                                } else {
                                    //utile pour deboguer
                                    //echo "<br>$query<br>";
                                    $result = mysqli_query($connect, $query);
                                    //utile pour deboguer
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
    };
    mysqli_close($connect);
    ?>

</body>

</html>