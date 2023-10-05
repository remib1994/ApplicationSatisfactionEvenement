<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="style.css" />

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
    // Check connection
    if ($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }
    $conn->set_charset("utf8");

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
        ?>  
        

    <?php
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
    <?php
    } ?>

<!-- INSÉRER LE CODE de Tristan -->


<?php
//function to remove special characters and spaces
function trojan($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data,ENT_QUOTES);
    return $data;
}




$conn->close();
?>
</body>
</html>