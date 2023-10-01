<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container" >
    <h1>FORMULAIRE</h1>
    <?php
    
    $erreur = false;

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        echo "<h1> POST == true </h1>";
        if(empty($_POST["nomEvent"])){
            $nomEventErr = "Le nom ne peut pas être vide";
                    $erreur  = true;
        }
        
        else{
            $nomEvent = trojan($_POST['nomEvent']);
            
        }
        if(empty($_POST["descEvent"])){
            $descEventErr = "Le mot de passe ne peux etre vide";
                    $erreur  = true;
        }
        else{
            $descEvent = trojan($_POST['descEvent']);
        }
        if(empty($_POST["dateEvent"])){
            $dateEventErr = "La confirmation de mot de passe ne peut pas être vide";
                    $erreur  = true;
        }
        else{
            $dateEvent = trojan($_POST['dateEvent']);
            
        }
        if(empty($_POST["lieuEvent"])){
            $lieuEventErr = "L'adresse ne peut pas être vide";
                    $erreur  = true;
        }
        else{
            $lieuEvent = trojan($_POST['lieuEvent']);
        
        }
         
         if($erreur == false){
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
        $sql = "INSERT INTO evenement (nomEvent, descEvent, dateEvent, lieuEvent, etat)
        VALUES ('$nomEvent', '$descEvent', '$dateEvent', '$lieuEvent', 'a venir')";
    
        if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        }
        ?>
        
        <?php

        $conn->close();
        }
    }
    if($_SERVER['REQUEST_METHOD'] != "POST" || $erreur == true){
        echo "<h1> POST == false </h1>";
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
        $sql = 'SELECT * FROM evenement WHERE id = $_GET["id"]';
    }
    ?>

</body>
</html>