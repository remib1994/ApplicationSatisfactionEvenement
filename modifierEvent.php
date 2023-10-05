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
        <div class="container" >

        <h1 class="titrePage">Modification de l'évenement</h1>
    <?php
      
        $nomEvent = "";
        $nomEventErr = "";
        $descEvent = "";
        $descEventErr = "";
        $dateEvent = "";
        $dateEventErr = "";
        $lieuEvent = "";
    
        $lieuEventErr = "";

        $event = "";
    $erreur = false;

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(empty($_POST["nomEvent"])){
            $nomEventErr = "Le nom ne peut pas être vide";
                    $erreur  = true;
        }
        
        else{
            $nomEvent = $_POST['nomEvent'];
            
        }
        if(empty($_POST["descEvent"])){
            $descEventErr = "La description ne peux etre vide";
                    $erreur  = true;
        }
        else{
            $descEvent = $_POST['descEvent'];
        }
        if(empty($_POST["dateEvent"])){
            $dateEventErr = "veilliez entrer une date";
                    $erreur  = true;
        }
        else{
            $dateEvent =$_POST['dateEvent'];
            
        }
        if(empty($_POST["lieuEvent"])){
            $lieuEventErr = "veilliez entrer un lieu";
                    $erreur  = true;
        }
        else{
            $lieuEvent =$_POST['lieuEvent'];
            
        }
        if($erreur == false){
            $servername = "cours.cegep3r.info";
            $username = "1238823";
            $password = "1238823";
            $db = "1238823-remi-berneche";
            $conn = new mysqli($servername, $username, $password, $db);
        // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    
        }
            $event = $_POST['idd'];
                    
                    
            $sqlGet5 = "DELETE FROM evenement_dept where id_Evenement =$event ";
            $result5 = $conn->query($sqlGet5);
        
        $sql = "UPDATE evenement set nom = '$nomEvent', description = '$descEvent', date = '$dateEvent', lieu = '$lieuEvent' where id = $event";
        $result = $conn->query($sql);
        $sql2 = "SELECT * FROM departement";
        $result2 = $conn->query($sql2);
        if($result2->num_rows > 0 ){
            while($row = $result2->fetch_assoc()){
                if(isset($_POST[$row['id']])){
                    $sql3 = "INSERT INTO evenement_dept (id_Evenement, id_Departement) VALUES ($event, $row[id])";
                    $result3 = $conn->query($sql3);
                }
            }
            }
            $conn->close();
            header("Location: index.php");

        }
      



    }
    if($_SERVER['REQUEST_METHOD'] != "POST" || $erreur == true){

        $servername = "cours.cegep3r.info";
        $username = "1238823";
        $password = "1238823";
        $db = "1238823-remi-berneche";
        $nomEvent = "";
        $nomEventErr = "";
        $descEvent = "";
        $descEventErr = "";
        $dateEvent = "";
        $dateEventErr = "";
        $lieuEvent = "";
    
        $lieuEventErr = "";
    
        // Create connection  
        $conn = new mysqli($servername, $username, $password, $db);
        // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    
        }

        $conn->set_charset("utf8");
        $event = $_GET['id'];
        $sql = 'SELECT * FROM evenement WHERE id = ' . $event . '';
        $result = $conn->query($sql);
        $sql2 = "SELECT * FROM departement";
        $result2 = $conn->query($sql2);
        $conn->set_charset("utf8");

        
        if($result->num_rows > 0 ){
            while($row   = $result->fetch_assoc()){
                $nomEvent = $row['nom'];
                $descEvent = $row['description'];
                $dateEvent = $row['date'];
                $lieuEvent = $row['lieu'];
            }
        }

        ?>
        <div class="container-fluid">
<div class="row col-12">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "post">

        
        <div class="row">
            <div class="col">
            <label for="idd">id ne pas toucher </label>
            <input name="idd" id="idd"  value="<?php echo $event ?> "  >
            </div>
            <div class="col">
    <label for="nomEvent">Nom de l'événement</label>
    <input type="text" name="nomEvent" id="nomEvent" value="<?php echo $nomEvent ?>" >
    <span class="error"><?php echo $nomEventErr;?></span>
    </div>
    <div class="col">
    <label for="descEvent">Description de l'événement</label>
    <input type="text" name="descEvent" id="descEvent" value="<?php echo $descEvent ?>">
    <span class="error"><?php echo $descEventErr;?></span>
    </div>
    <div class="col">
    <label for="dateEvent">Date de l'événement</label>
    <input type="date" name="dateEvent" id="dateEvent" value="<?php echo $dateEvent ?>">
    <span class="error"><?php echo $dateEventErr;?></span>
    </div>
    <div class="col">
    <label for="lieuEvent">Lieu de l'événement</label>
    <input name="lieuEvent"  id="lieuEvent" type="text" value="<?php echo $lieuEvent?>">
    <span class="error"><?php echo $lieuEventErr;?></span>
    </div>
    </div>
    <div class="row">
    <div class="col ">
    <label for="departement">Departement</label>
    <?php
    


    $sql3 = 'SELECT * FROM evenement_dept WHERE id_Evenement = ' . $event . ' ';
    $result3 = $conn->query($sql3);
    $list   = array();
    if($result3->num_rows > 0 ){
        while($row   = $result3->fetch_assoc()){
            array_push($list, $row['id_Departement']);
        }
    }



    
    if($result2->num_rows > 0 ){
        while($row = $result2->fetch_assoc()){
            $present = false;
            for($i = 0; $i < count($list); $i++){
                if($list[$i] == $row['id']){
                    $present = true;
                  
                }
                else{
                   
                }
            }
            if($present == true){

                ?>
                <input type="checkbox" name="<?php echo $row["id"]?>" id="<?php echo $row["id"]?>" value="<?php echo $row['id'] ?>" checked></input><label for="<?php echo $row['id'] ?>"> <?php echo $row['code'] . " " . $row['nom'] ?></label><br>
                <?php
            }
            else{
                ?>
                <input type="checkbox" name="<?php echo $row["id"]?>" id="<?php echo $row["id"]?>" value="<?php echo $row['id'] ?>"></input><label for="<?php echo $row['id'] ?>"> <?php echo $row['code'] . " " . $row['nom'] ?></label><br>
                <?php
            }
        }

    }
            ?>
    </div>
    </div>

    <input type="submit" value="Submit">
    </form>
    </div>
    </div>
<?php
    }



    ?>

</body>
</html>