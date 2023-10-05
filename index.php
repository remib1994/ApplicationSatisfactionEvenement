<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <title>Gestionnaire évènement</title>
</head>
<body>
    <?php

    //Variable de connexion BD
    $servername = "cours.cegep3r.info";
    $DBusername = "1238823";
    $DBpassword = "1238823";
    $db = "1238823-remi-berneche";

    //create connection
    $conn = new mysqli($servername,$DBusername,$DBpassword,$db);
    $conn->set_charset("utf8");
    // Check connection
    if ($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }
    $conn->set_charset("utf8");

    $nomEvent = "";
    $nomEventErr = "";
    $descEvent = "";
    $descEventErr = "";
    $dateEvent = "";
    $dateEventErr = "";
    $lieuEvent = "";
    $lieuEventErr = "";
    $erreur = false;


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password = sha1($password,false);
        $email = trojan($email);
        $password = trojan($password);
        $sql = "SELECT * FROM user where email='$email' and password='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION["connexion"] = true;
            $_SESSION["email"] = $row["email"];
            $_SESSION["username"] = $row["username"];
            $_SESSION["id"] = $row["id"];
            $_SESSION["admin"] = $row["admin"];
        }
    }

    if(isset($_GET['id'])){

        if(isset($_GET['choix'])){
            switch($_GET['choix']){
                case 1:
                    $idEvenement = $_GET['id'];
                    $sqlGet = "UPDATE evenement set etat = 'terminer' where id =$idEvenement ";
                    $result = $conn->query($sqlGet);
                    break;
                case 2:
                    $idEvenement = $_GET['id'];
                    $sqlGet = "UPDATE evenement set etat = 'en cours' where id =$idEvenement ";
                    $result = $conn->query($sqlGet);
                    break;
                case 3:
                    $idEvenement = $_GET['id'];


                    $sqlGet5 = "DELETE FROM evenement_dept where id_Evenement =$idEvenement ";
                    $result5 = $conn->query($sqlGet5);



                    $sqlGet = "DELETE FROM evenement where id =$idEvenement ";
                    $result = $conn->query($sqlGet);

                    break;
                case 4:
                    $idEvenement = $_GET['id'];
                    $sqlGet = "UPDATE evenement set etat = 'a venir' where id =$idEvenement ";
                    $result = $conn->query($sqlGet);
                    break;


            }

        }

    }
    $sql = "SELECT * FROM evenement WHERE etat = 'terminer'";
    $result = $conn->query($sql);
    $sql2 = "SELECT * FROM evenement WHERE etat = 'en cours'";
    $result2 = $conn->query($sql2);
    $sql3 = "SELECT * FROM evenement WHERE etat = 'a venir'";
    $result3 = $conn->query($sql3);


    if(!isset($_SESSION["connexion"]) or $_SESSION["connexion"] != true){ ?>
        <nav class="navbar navbar-dark navbar-expand-lg bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand mx-2" href="index.php">
                    <i class="bi bi-speedometer"></i>SatisfactoPoll
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarScroll">
                    <a class="btn btn-outline-warning btn-primary" href="index.php" role="button">Se connecter <i class="bi bi-box-arrow-left"></i></a>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-3">
                    <h1>Connexion</h1>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <div class="mb-3">
                            <label for="email" class="form-label">Adresse email</label>
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text">Nous ne partagerons jamais votre email avec qui que ce soit.</div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <button type="submit" class="btn btn-primary">Se connecter</button>
                    </form>
                </div>
            </div>
        </div>
    <?php
    }else{ ?>

        <nav class="navbar navbar-dark navbar-expand-lg bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand mx-2" href="index.php">
                    <i class="bi bi-speedometer"></i>SatisfactoPoll
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarScroll">
                    <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Évènement
                            </a>
                            <ul class="dropdown-menu">
                                <?php
                                if($_SESSION["admin"] == 1){
                                    echo "<li><a class='dropdown-item' href='creerEvenement.php'>Créer</a></li>";
                                    echo "<li><hr class='dropdown-divider'></li>";
                                }
                                ?>
                                <li><a class="dropdown-item" href="index.php">Afficher</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Département
                            </a>
                            <ul class="dropdown-menu">
                                <?php
                                if($_SESSION["admin"] == 1){
                                    echo "<li><a class='dropdown-item' href='departementCreer.php'>Créer</a></li>";
                                    echo "<li><hr class='dropdown-divider'></li>";
                                }
                                ?>
                                <li><a class="dropdown-item" href="departementAfficher.php">Afficher</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Utilisateur
                            </a>
                            <ul class="dropdown-menu">
                                <?php
                                if($_SESSION["admin"] == 1){
                                    echo "<li><a class='dropdown-item' href='userCreer.php'>Créer</a></li>";
                                    echo "<li><hr class='dropdown-divider'></li>";
                                }
                                ?>
                                <li><a class="dropdown-item" href="userAfficher.php">Afficher</a></li>
                            </ul>
                        </li>
                    </ul>
                        <span class="mx-2 navbar-text">
                            Bienvenue <a class='text-warning' href='userModifier.php?id=<?php echo $_SESSION['id']; ?>'><?php echo $_SESSION["username"]; ?>
                            </a>
                        </span>
                        <a href="deconnecter.php" class="mx-2 link-warning">Se déconnecter <i class="bi bi-box-arrow-right"></i></a>
                </div>

            </div>
        </nav>
    <!-- affichage des ellement -->
    <div class="container-fluid">
        <div class="row col-12">

            <button class="accordion bg-primary ">terminer</button>
            <div class="panel">
                <table class="table table-striped table-info"  >
                    <tr>
                        <th class="tdCat  ">id</th>
                        <th class="tdCat  ">nom</th>
                        <th class="tdCat  ">description</th>
                        <th class="tdCat ">date</th>
                        <th class="tdCat">lieu</th>
                        <th class="tdCat">departement</th>
                        <th class="tdCat">etat</th>
                        <th class="tdCat">resultat étudiant</th>
                        <th class="tdCat">resultat professeur</th>

                    </tr>
                    <?php
                    if($result->num_rows > 0 ){
                    while($row = $result->fetch_assoc()){
                        ?>

                        <tr >
                            <td class="tdList"><?php echo $row["id"] ?></td>
                            <td class="tdList"><?php echo $row["nom"] ?></td>
                            <td class="tdList"><?php echo $row["description"]?></td>
                            <td class="tdList"><?php echo $row["date"] ?></td>
                            <td class="tdList"><?php echo $row["lieu"] ?></td>
                            <td class="tdList">
                                <?php $sql11 = 'SELECT nom,code
FROM departement
WHERE id IN (
SELECT id_departement
FROM evenement_dept
WHERE id_Evenement =' . $row["id"] . ')';
                                $result11 = $conn->query($sql11);
                                if($result11->num_rows > 0 ){
                                    while($row11 = $result11->fetch_assoc()){
                                        ?>
                                        <?php
                                        echo $row11["code" ]." ".$row11["nom" ]."<br>";
                                    }
                                }
                                ?></td>




                            <td class="tdList" ><?php echo $row["etat"] ?></td>
                            <td class="tdlist">
                                <label> 😀  : <?php echo $row["Good"] ?> </label>
                                <label> 😑  : <?php echo $row["Ok"] ?> </label>
                                <label> ☹️  : <?php echo $row["Bad"] ?> </label>
                            </td>
                            <td class="tdlist">
                                <label> 😀  : <?php echo $row["GoodAdmin"] ?>  </label>
                                <label> 😑  : <?php echo $row["OkAdmin"] ?> </label>
                                <label> ☹️  : <?php echo $row["BadAdmin"] ?> </label>
                            </td>
                        </tr>

                        <?php
                    }
                    ?>
                </table>
            </div>

            <button class="accordion bg-primary">En cours</button>
            <div class="panel">
                <table class="table table-striped table-info" >
                    <tr>
                        <th class="tdCat">id</th>
                        <th class="tdCat">nom</th>
                        <th class="tdCat">description</th>
                        <th class="tdCat">date</th>
                        <th class="tdCat">lieu</th>
                        <th class="tdCat">departement</th>
                        <th class="tdCat">etat</th>
                        <th class="tdCat">resultat étudiant</th>
                        <th class="tdCat">resultat professeur</th>
                        <th class="tdCat">option</th>
                        <th class="tdCat">action</th>

                    </tr>
                    <?php
                    if($result2->num_rows > 0 ){
                        while($row2 = $result2->fetch_assoc()){
                            ?>
                            <tr >
                                <td class="tdList"><?php echo $row2["id"] ?></td>
                                <td class="tdList"><?php echo $row2["nom"] ?></td>
                                <td class="tdList"><?php echo $row2["description"]?></td>
                                <td class="tdList"><?php echo $row2["date"] ?></td>
                                <td class="tdList"><?php echo $row2["lieu"] ?></td>

                                <td class="tdList">
                                    <?php $sql22 = 'SELECT nom,code
FROM departement
WHERE id IN (
SELECT id_departement
FROM evenement_dept
WHERE id_Evenement =' . $row2["id"] . ')';
                                    $result22 = $conn->query($sql22);
                                    $conn->set_charset("utf8");
                                    if($result22->num_rows > 0 ){
                                        while($row22 = $result22->fetch_assoc()){
                                            ?>
                                            <?php
                                            echo $row22["code" ]." ".$row22["nom" ]."<br>";
                                        }
                                    }
                                    ?></td>


                                <td class="tdList" ><?php echo $row2["etat"] ?></td>

                                <td class="tdlist">
                                    <label> 😀  : <?php echo $row2["Good"] ?> </label>
                                    <label> 😑  : <?php echo $row2["Ok"] ?> </label>
                                    <label> ☹️  : <?php echo $row2["Bad"] ?> </label>
                                </td>
                                <td class="tdlist">
                                    <label> 😀  : <?php echo $row2["GoodAdmin"] ?>  </label>
                                    <label> 😑  : <?php echo $row2["OkAdmin"] ?> </label>
                                    <label> ☹️  : <?php echo $row2["BadAdmin"] ?> </label>
                                </td>
                                <td class="tdlist"><a href="modifierEvent.php?id=<?php echo $row2["id"] ?>">🛠️</a>
                                </td>
                                <td class="tdlist"><button class="btn btn-primary" onclick="window.location.href='evenementEnCoursEtu.php?id=<?php echo $row2['id'] ?>'">VOTE ÉTUDIANT</button>
                                    <button class="btn btn-primary" onclick="window.location.href='evenementEnCourPers.php?id=<?php echo $row2['id'] ?>'">VOTE PROFESSEUR</button>
                                    <button class="btn btn-primary" onclick="window.location.href='index.php?id=<?php echo $row2['id'] ?>&choix=1'">TERMINER</button>

                                    <button class="btn btn-primary" onclick="window.location.href='index.php?id=<?php echo $row2['id'] ?>&choix=4'">ANNULER</button>

                                </td>

                            </tr>

                            <?php
                        }
                    }
                    ?>
                </table>
            </div>


            <button class="accordion bg-primary">A venir</button>
            <div class="panel">
                <table class="table table-striped table-info" >
                    <tr>
                        <th class="tdCat">id</th>
                        <th class="tdCat">nom</th>
                        <th class="tdCat">description</th>
                        <th class="tdCat">date</th>
                        <th class="tdCat">lieu</th>
                        <th class="tdCat">departement</th>
                        <th class="tdCat">etat</th>
                        <th class="tdCat">option</th>
                        <th class="tdCat">action</th>


                    </tr>
                    <?php
                    if($result3->num_rows > 0 ){
                        while($row3 = $result3->fetch_assoc()){
                            ?>
                            <tr >
                                <td class="tdList"><?php echo $row3["id"] ?></td>
                                <td class="tdList"><?php echo $row3["nom"] ?></td>
                                <td class="tdList"><?php echo $row3["description"]?></td>
                                <td class="tdList"><?php echo $row3["date"] ?></td>
                                <td class="tdList"><?php echo $row3["lieu"] ?></td>
                                <td class="tdList">
                                    <?php $sql33 = 'SELECT nom,code
FROM departement
WHERE id IN (
SELECT id_departement
FROM evenement_dept
WHERE id_Evenement =' . $row3["id"] . ')';
                                    $result33 = $conn->query($sql33);
                                    if($result33->num_rows > 0 ){
                                        while($row33 = $result33->fetch_assoc()){
                                            ?>
                                            <?php
                                            echo $row33["code" ]." ".$row33["nom" ]."<br>";
                                        }
                                    }
                                    ?></td>




                                <td class="tdList" ><?php echo $row3["etat"] ?></td>
                                <td class="tdlist"><a href="modifierEvent.php?id=<?php echo $row3["id"] ?>">🛠️</a>
                                    <a onclick="document.getElementById('id01').style.display='block'" href="supprimerEvent.php?id=<?php echo $row3["id"] ?>" >❌</a></td>

                                <td class="tdlist"><button class="btn btn-primary" onclick="window.location.href='index.php?id=<?php echo $row3['id'] ?>&choix=2'">COMMENCER</button></td>


                            </tr>

                            <?php
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
        <?php
        }


        ?>
    <?php
    }
    $conn->close();
    function trojan($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data,ENT_QUOTES);
        return $data; ?>

        <?php
    }

    ?>


    <script src="script.js"></script>
</body>
</html>