<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css" /> 
   
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
 
    <title>Document</title>
</head>
<body>
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
            $servername = "localhost";
            $username = "root";
            $password = "root";
            $db = "appsatisfaction";
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="script.js"></script>
</body>
</html>