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

    $nom = $code = $codeError= $nomError = "";



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
            <div class="col-sm-3 text-center align-content-center my-5">
                <h1>Vous devez être connecté pour voir cette page</h1>
                <button type="button" class="btn btn-primary" onclick="window.location.href='index.php'">Se connecter</button>
            </div>
        </div>

        <?php
    }else{
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //Variable de connexion BD
            $servername = "cours.cegep3r.info";
            $DBusername = "1238823";
            $DBpassword = "1238823";
            $db = "1238823-remi-berneche";
            //create connection
            $conn = new mysqli($servername, $DBusername, $DBpassword, $db);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $code = $_POST['code'];
            $nom = $_POST['nom'];

            //create connection
            $conn = new mysqli($servername,$DBusername,$DBpassword,$db);
            // Check connection
            if ($conn->connect_error){
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM departement where code='$code'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $codeError = "Ce code est déjà utilisé";
            }else{
                $sql = "INSERT INTO departement (code, nom) VALUES ('$code', '$nom')";
                $result = $conn->query($sql);
                header("Location: departementAfficher.php");
            }
        }

        ?>

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
                                <li><a class="dropdown-item" href="#">Créer</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Afficher</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Département
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Créer</a></li>
                                <li><a class="dropdown-item" href="#">Afficher</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Utilisateur
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Créer</a></li>
                                <li><a class="dropdown-item" href="#">Afficher</a></li>
                            </ul>
                        </li>
                    </ul>
                    <span class="mx-2 navbar-text">
                                <?php echo "Bienvenue ".$_SESSION["username"]; ?>
                                </span>
                    <a href="deconnecter.php" class="mx-2 link-warning">Se déconnecter <i class="bi bi-box-arrow-right"></i></a>
                </div>

            </div>
        </nav>

        //Form for a code and a name of departement
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-3">
                    <h1>Créer un département</h1>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <div class="mb-3">
                            <label for="code" class="form-label">Code du département</label>
                            <input type="text" class="form-control" id="code" name="code" aria-describedby="codeHelp">
                            <label for="code" class="form-label text-danger" id="codeError"><?php echo $codeError?></label>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nom du département</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <button type="submit" class="btn btn-primary">Créer</button>
                    </form>
                </div>
            </div>
        </div>
        <?php
    }
} ?>



</body>
</html>