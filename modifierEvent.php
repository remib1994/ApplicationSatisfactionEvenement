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

    }
    if($_SERVER['REQUEST_METHOD'] != "POST" || $erreur == true){
       
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $db = "appsatisfaction";
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
        $event = $_GET['id'];
        $sql = 'SELECT * FROM evenement';
        $result = $conn->query($sql);
        $sql2 = "SELECT * FROM departement";
        $result2 = $conn->query($sql2);
        
        
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

    <label for="nomEvent">Nom de l'événement</label>
    <input type="text" name="nomEvent" id="nomEvent" value="<?php echo $nomEvent ?>" >
    <span class="error"><?php echo $nomEventErr;?></span>
    <br>
    <label for="descEvent">Description de l'événement</label>
    <input type="text" name="descEvent" id="descEvent" value="<?php echo $descEvent ?>">
    <span class="error"><?php echo $descEventErr;?></span>
    <label for="dateEvent">Date de l'événement</label>
    <input type="date" name="dateEvent" id="dateEvent" value="<?php echo $dateEvent ?>">
    <span class="error"><?php echo $dateEventErr;?></span>
    <label for="lieuEvent">Lieu de l'événement</label>
    <input name="lieuEvent"  id="lieuEvent" type="text" value="<?php echo $lieuEvent?>">
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
        for($i = 0; $i < count($list); $i++){
            if($list[$i] == $row['id']){
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
        
        ?>
        <?php
    }
    ?>
    <span class="error"><?php echo $lieuEventErr;?></span>
    <input type="submit" value="Submit">
    </form>
    </div>
    </div>
<?php
    }
}
    ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="script.js"></script>
</body>
</html>