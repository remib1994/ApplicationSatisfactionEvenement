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
    <script src="js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="style.css" /> 
    
    <title>Gestionnaire évènement</title>
</head>
<body>    
    <?php

    //Variable de connexion BD
    $servername = "cours.cegep3r.info";
    $username = "1238823";
    $password = "1238823";
    $db = "1238823-remi-berneche";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password = sha1($password,false);

        //create connection
        $conn = new mysqli($servername,$DBusername,$DBpassword,$db);
        // Check connection
        if ($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM user where email='$email' and password='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION["connexion"] = true;
            $_SESSION["email"] = $row["email"];
            $_SESSION["username"] = $row["username"];
        }
    }
        ?>  
        

    <?php
    if(!isset($_SESSION["connexion"]) or $_SESSION["connexion"] != true){ ?>   
        <nav class="row navbar navbar-expand-sm navbar-dark bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">
                    <i class="bi bi-speedometer mx-2"></i>SatisfactoPoll
                </a>        
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                        <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="mynavbar">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item" >
                        <a class="nav-link" href="index.php">Connexion</a>
                    </li>
                </ul>                  
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
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
    <?php
    }else{ ?>
        <nav class="row navbar navbar-expand-sm navbar-dark bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand mx-2" href="index.php">
                    <i class="bi bi-speedometer"></i>SatisfactoPoll
                </a>        
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                        <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="mynavbar">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item" >
                        <a class="nav-link" href="index.php">Accueil</a>
                    </li>
                    <li class="nav-item" >
                        <a class="nav-link" href="creerEvenement.php">Créer un évènement</a>
                    </li>
                    <li>
                        <div class="dropdown">
                            <button class="btn btn-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Utilisateur
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Créer</a></li>
                                <li><a class="dropdown-item" href="#">Afficher</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item" >
                        <a class="nav-link" href="creeruser.php">Créer un utilisateur</a>
                    </li>

                </ul>      
                            
                </div>
                <div> 
                <span class="mx-2 navbar-text">
                        <?php echo "Bienvenue ".$_SESSION["username"]; ?>
                    </span>
                    
                    <a href="deconnecter.php" class="mx-2 link-warning">Se déconnecter <i class="bi bi-box-arrow-right"></i></a>
                    
                </div>
                 
            </div>
                    
        </nav>
        
        
    <?php
    } ?>
        
<?php


$nomEvent = "";
$nomEventErr = "";
$descEvent = "";
$descEventErr = "";
$dateEvent = "";
$dateEventErr = "";
$lieuEvent = "";
$lieuEventErr = "";
$erreur = false;



if($_SERVER['REQUEST_METHOD'] != "POST" || $erreur == true){
    $servername = "localhost";
    $DBusername = "root";
    $DBpassword = "root";
    $db = "appsatisfaction";

    // Create connection  
    $conn = new mysqli($servername, $DBusername, $DBpassword, $db);
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
        
    }
    $sql = "SELECT * FROM evenement";
    $result = $conn->query($sql);
}

?>

<!-- affichage des elements -->
<div class="container-fluid">
<div class="row col-12">
<table class="table table-striped" >
  <tr>
    <th class="tdCat">id</th>
    <th class="tdCat">nom</th>
    <th class="tdCat">description</th>
    <th class="tdCat">date</th>
    <th class="tdCat">lieu</th>
    <th class="tdCat">etat</th>

  </tr>


    <!-- fin affichage des ellement -->

</table>
</div>
<a href="creerEvenement.php">Créer un événement</a>
</div>


</body>
</html>