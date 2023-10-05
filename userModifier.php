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

$username = $email= $password = $admin= $passwordError = $usernameError= $userEmailError = "";

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
        $code = $nom = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $valide = true;
            $id = $_POST['id'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $password = SHA1($password);
            $admin = 0;


            if(isset($_POST['admin'])){
                $admin = $_POST['admin'];
            }else{
                $admin= 0;
            }
            if(empty($username)){
                $usernameError = "Le nom d'usagé est requis.";
                $valide = false;
            }
            if(empty($email)){
                $userEmailError = "Une adresse courriel est requise.";
                $valide = false;
            }
            if(empty($password)){
                $password = "utilisateur";
                $password = SHA1($password);
            }

            if($valide){
                $sql = "UPDATE user SET username='$username' , email='$email', password='$password', admin='$admin' WHERE id='$id'";
                if ($conn->query($sql) === TRUE) {
                    echo "Le compte a été modifié avec succès";
                    header("Location: userAfficher.php");

                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }



        }
        if(!empty($_GET['id'])){
            $id = $_GET['id'];
            //create connection
            $conn = new mysqli($servername,$DBusername,$DBpassword,$db);
            // Check connection
            if ($conn->connect_error){
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM user where id='$id'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                $username = $row['username'];
                $email = $row['email'];
                $admin = $row['admin'];
                $id = $row['id'];
            }
            if($admin == 1){
                $admin = "checked";
        }

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
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-sm-3 text-center align-content-center my-5">
                            <h1>Vous devez être connecté pour voir cette page</h1>
                            <button type="button" class="btn btn-primary" onclick="window.location.href='index.php'">Se connecter</button>
                        </div>
                    </div>
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

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-3">
                    <?php
                    if($_SESSION['admin'] == 1){ ?>
                        <h1>Créer un usagé</h1>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                            <div class="mb-3">
                                <input type="hidden" name="id" value="<?php echo $id ?>">
                                <label for="username" class="form-label">Nom usagé</label>
                                <input type="text" class="form-control" id="username" name="username" value="<?php echo $username ?>" aria-describedby="codeHelp">
                                <label for="username" class="form-label text-danger" id="codeError"><?php echo $usernameError?></label><br>
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email" value="<?php echo $email ?>">
                                <label for="email" class="form-label text-danger"><?php echo $userEmailError ?></label><br>
                                <label for="password" class="form-label">Mot de passe</label>
                                <input type="text" class="form-control" id="password" name="password">
                                <label for="password" class="form-label text-danger"><?php echo $passwordError ?></label><br>
                                <?php
                                if( $_SESSION['admin'] ==1) { ?>
                                <input type="checkbox" id="admin" name="admin" value="1" <?php echo $admin ?>>
                                <label for="admin" class="form-label">Compte administrateur</label>
                                <?php
                                } ?>
                            </div>
                            <div class="mb-3">

                                <p>Veuillez notez que le mot de passe par défaut est : utilisateur.<br>
                                    L'utilisateur peut le changer une fois connecté.</p>


                            </div>
                            <button type="submit" class="btn btn-primary">Créer</button>
                        </form>
                        <?php
                    }else{
                        echo "<h1>Vous devez être administrateur pour voir cette page.</h1>";
                    }
                    ?>

                </div>
            </div>
        </div>
        <?php

                }
    } ?>



</body>
</html>