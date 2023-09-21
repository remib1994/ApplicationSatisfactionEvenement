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
    <link rel="stylesheet" type="text/css" href="style.css" /> 
    
    <title>Gestionnaire évènement</title>
</head>
<body>    
    <?php

    //Variable de connexion BD
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $db = "appsatisfaction";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password = sha1($password,false);

        //create connection
        $conn = new mysqli($servername,$username,$password,$dbname);
        // Check connection
        if ($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM user where email='$email' and password='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION["connexion"] = true;
            $_SESSION["type"] = $row["type"];
            $_SESSION["matricule"] = $row["matricule"];
        }
    }
        ?>  

    <?php
    if(!isset($_SESSION["connexion"]) or $_SESSION["connexion"] != true){ ?>
        <nav class="row navbar navbar-expand-sm navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php"><i class="bi bi-book"></i>SatisfactoPoll</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="mynavbar">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item" >
                        <a class="nav-link" href="index.php">Connexion</a>
                    </li>
                    <li class="nav-item" >
                        <a class="nav-link" href="index.php"></i>Afficher</a>
                    </li>
                </ul>                  
                <form class="d-flex">
                    <input class="form-control me-2" type="text" placeholder="Search">
                    <button class="btn btn-primary" type="button">Search</button>
                </form>
                </div>
            </div>
        </nav>
    <?php
    }else{
        //create connection
        $conn = new mysqli($servername,$username,$password,$dbname);
        // Check connection
        if ($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * from ";
        $result = $conn->query($sql);

    }

        ?>

        


$nomEvent = "";
$nomEventErr = "";
$descEvent = "";
$descEventErr = "";
$dateEvent = "";
$dateEventErr = "";
$lieuEvent = "";
$lieuEventErr = "";
$erreur = false;
$_SESSION["connexion"] = true;



if($_SERVER['REQUEST_METHOD'] != "POST" || $erreur == true){
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $db = "appsatisfaction";

    // Create connection  
    $conn = new mysqli($servername, $username, $password, $db);
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
        
    }
    $sql = "SELECT * FROM evenement";
    $result = $conn->query($sql);
}

?>

<!-- affichage des ellement -->
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

<?php
if($result->num_rows > 0 ){
    while($row = $result->fetch_assoc()){
?>
<tr>
            <td class="tdList"><?php echo $row["id"] ?></td>
            <td class="tdList"><?php echo $row["nom"] ?></td>
            <td class="tdList"><?php echo $row["description"]?></td>
            <td class="tdList"><?php echo $row["date"] ?></td>
            <td class="tdList"><?php echo $row["lieu"] ?></td>
            <td class="tdList"><?php echo $row["etat"] ?></td>
            <td class="tdlist"><a href="modifier.php?id=<?php echo $row["id"] ?>">🛠️</a></td>
            <td class="tdlist"><a href="supprimer.php?id=<?php echo $row["id"] ?>">❌</a></td>
        </tr>
       
        <?php
    }
}
    else{
        echo "0 resultats";
    }
    
    ?>
    <!-- fin affichage des ellement -->

</table>
</div>
<a href="creerEvenement.php">Créer un événement</a>
</div>


</body>
</html>