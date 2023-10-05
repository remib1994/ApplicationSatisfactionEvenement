<?php
session_start();
?>
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
        

        $servername = "localhost";
        $username = "root";
        $password = "root";
        $db = "appsatisfaction";
    
        // Create connection  
        $conn = new mysqli($servername, $username, $password, $db);
        $conn->set_charset("utf8");
        // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        
        }
        $sql = "SELECT * FROM departement";
        $result = $conn->query($sql);

       

        if($result->num_rows > 0 ){
            while($row = $result->fetch_assoc()){
                $nbrDepartement = $row["id"];
            }
        }
        

        $dep = array();
        for($i = 1; $i <= $nbrDepartement; $i++){
            if(isset($_POST[$i])){
                $dep[] = $_POST[$i];
            }
        }
       
        $conn->close();
         
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
        $sql = "INSERT INTO evenement (nom, description, date, lieu, etat, id_user) VALUES ('$nomEvent', '$descEvent', '$dateEvent', '$lieuEvent', 'a venir',1)";
        $conn->query($sql);
        for($i = 0; $i < count($dep); $i++){
            $sql2 ="INSERT INTO evenement_dept (id_evenement, id_departement) VALUES ((SELECT id FROM evenement WHERE nom = '$nomEvent'), '$dep[$i]')";
            echo $sql2;
            if ($conn->query($sql2) == TRUE) {
                echo "New record created successfully";
              } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
              }
        }
        $sql = "SELECT * FROM evenement WHERE etat = 'a venir'";
    $result= $conn->query($sql);
        ?>
        <table class="table table-striped" >
  <tr>
    <th class="tdCat">id</th>
    <th class="tdCat">nom</th>
    <th class="tdCat">description</th>
    <th class="tdCat">date</th>
    <th class="tdCat">lieu</th>
    <th class="tdCat">departement</th>
    <th class="tdCat">etat</th>

  </tr>
  <?php
if($result->num_rows > 0 ){
    while($row = $result->fetch_assoc()){
?> 
<tr >
            <td class="tdList"><?php echo $row["id"] ?></td>
            <td class="tdList"><?php echo $row["nom"] ?></td>
            <td class="tdList"><?php echo $row["description"]?></td>
            <td class="tdList"><?php echo $row["date"] ?></td>
            <td class="tdList"><?php echo $row["lieu"] ?></td>
            <td class="tdList">
           <?php $sql11 = 'SELECT nom,code
FROM departement
WHERE id IN (
SELECT id_departement
FROM evenement_dept
WHERE id_Evenement =' . $row["id"] . ')';
    $result11 = $conn->query($sql11);
    if($result11->num_rows > 0 ){
        while($row11 = $result11->fetch_assoc()){
            ?>
            <?php
     echo $row11["code" ]." ".$row11["nom" ]."<br>";
       }
    }
        ?></td>
     
     
    
    
            <td class="tdList" ><?php echo $row["etat"] ?></td>
            <td class="tdlist"><a href="modifier.php?id=<?php echo $row["id"] ?>">🛠️</a></td>
            <td class="tdlist"><a href="supprimer.php?id=<?php echo $row["id"] ?>">❌</a></td>
        </tr>
        
        <?php
    }
}
?>
</table>
    <input type="button" value="Retour" onclick="window.location.href='index.php'" />
        <?php   
        $conn->close();
        }
    }

if($_SERVER['REQUEST_METHOD'] != "POST" || $erreur == true){
    echo '<h1 class="titrePage">CREATION DE LÉVENEMENT</h1>';
    $servername = "localhost";
        $username = "root";
        $password = "root";
        $db = "appsatisfaction";
    
        // Create connection  
        $conn = new mysqli($servername, $username, $password, $db);
        $conn->set_charset("utf8");
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
        <div class="row">

    <div class="col">
<label for="nomEvent">Nom de l'événement</label>
    <input type="text" name="nomEvent" id="nomEvent" value="<?php echo $nomEvent ?>">
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
    <input name="lieuEvent" id="lieuEvent" type="text">

    <span class="error"><?php echo $lieuEventErr;?></span>
</div>
</div>
      <div class="row">
        <div class="col">
        <label for="departement">Departement</label>
        <br>

    <?php
if($result->num_rows > 0 ){
    while($row = $result->fetch_assoc()){
        ?>
        <input type="checkbox" name="<?php echo $row["id"]?>" id="<?php echo $row["id"]?>" value="<?php echo $row['id'] ?>"></input><label for="<?php echo $row['id'] ?>"> <?php echo $row['code'] . " " . $row['nom'] ?></label><br>
        <?php
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