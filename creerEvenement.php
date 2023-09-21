<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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
    //Variable de connexion BD
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
    $conn->query('SET NAMES utf8');


    $sql = "SELECT * FROM departement";
    $result = $conn->query($sql);
    ?>
    <h1>LISTE DES EVENEMENTS</h1>
    <div class="container-fluid">
    <div class="row col-12">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <label for="nomE"><h5>nom de l'evenement : </h5></label><input type="text" name="nomE" id="nomE" value="<?php echo $nomEvent;?>">
    <p style="color:red;"><?php echo $nomEventErr; ?></p>
    description de l'evenement : <input type="text" name="descE"  value="<?php echo $descEvent;?>">
    <p style="color:red;"><?php echo $descEventErr; ?></p>
    date de l'evenement : <input type="date" name="dateE"  value="<?php echo $dateEvent;?>">
    <p style="color:red;"><?php echo $dateEventErr; ?></p>
    lieu de l'evenement : <input type="text" name="lieuE"  value="<?php echo $lieuEvent;?>">
    <p style="color:red;"><?php echo $lieuEventErr; ?></p>
    <label for="departement"><h5>Département pour l'évènement : </h5></label><br>
    <label for="departement"><h6>Appuyer sur ctrl+click pour selectionner plusieurs départements ou maj+click pour tout les sélectionner.</h6></label>
    <select id="departement" name="departementE" class="form-select form-select-sm" multiple aria-label="Département pour l'évènement">
    <?php

    if($result->num_rows > 0 ){
    
        while($row = $result->fetch_assoc()){
        echo "<option value=".$row["id"].">".$row["code"]." ".$row["nom"]."</option>";       

        }
    }

    ?>
    </select>
    <input type="submit" value="Créer l'événement">
    </form>
        </div>
    </div>
    <?php
        $conn->close();}

    ?>

</body>
</html>