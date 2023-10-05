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
    <link rel="stylesheet" type="text/css" href="style.css" /> 
   
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
 
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
            $descEventErr = "La description ne peux etre vide";
                    $erreur  = true;
        }
        else{
            $descEvent = trojan($_POST['descEvent']);
        }
        if(empty($_POST["dateEvent"])){
            $dateEventErr = "veilliez entrer une date";
                    $erreur  = true;
        }
        else{
            $dateEvent = trojan($_POST['dateEvent']);
            
        }
        if(empty($_POST["lieuEvent"])){
            $lieuEventErr = "velliez selextion au minimum un lieu";
                    $erreur  = true;
        }
        else{
            if (is_array($_POST['lieuEvent'])) {
                foreach($_POST['lieuEvent'] as $value){
                    $lieuEvent = $lieuEvent . $value . " ";
                }
            }
        
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
        $sql = "INSERT INTO evenement (nom, description, date, lieu, etat) VALUES ('$nomEvent', '$descEvent', '$dateEvent', '$lieuEvent', 'a venir')";
        if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
        }
    }

if($_SERVER['REQUEST_METHOD'] != "POST" || $erreur == true){
    echo "<h1>LISTE DES EVENEMENTS</h1>";
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
        $sql = "SELECT code, nom, id FROM departement";
        $result = $conn->query($sql);
    ?>
<div class="container-fluid">
<div class="row col-12">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "post">

    <label for="nomEvent">Nom de l'événement</label>
    <input type="text" name="nomEvent" id="nomEvent" value="<?php echo $nomEvent ?>">
    <span class="error"><?php echo $nomEventErr;?></span>
    <br>
    <label for="descEvent">Description de l'événement</label>
    <input type="text" name="descEvent" id="descEvent" value="<?php echo $descEvent ?>">
    <span class="error"><?php echo $descEventErr;?></span>
    <label for="dateEvent">Date de l'événement</label>
    <input type="date" name="dateEvent" id="dateEvent" value="<?php echo $dateEvent ?>">
    <span class="error"><?php echo $dateEventErr;?></span>
    <label for="lieuEvent">Lieu de l'événement</label>
    <select name="lieuEvent" id="lieuEvent"  multiple>

    <?php
if($result->num_rows > 0 ){
    while($row = $result->fetch_assoc()){
        ?>
        <option value="<?php echo $row['id'] ?>"><?php echo $row['code'] . " " . $row['nom'] ?></option>
        <?php
    }
}
    ?>
    <span class="error"><?php echo $lieuEventErr;?></span>
    <input type="submit" value="Submit">
    </form>
    </div>
    </div>
        
    
    <?php
        $conn->close();}

    ?>

</body>
</html>