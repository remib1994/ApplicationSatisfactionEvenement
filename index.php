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
    <h1>LISTE DES EVENEMENTS</h1>
    
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
$_SESSION["connexion"] = true;



if($_SERVER['REQUEST_METHOD'] != "POST" || $erreur == true){
    $servername = "cours.cegep3r.info";
    $username = "1238823";
    $password = "1238823";
    $db = "1238823-remi-berneche";

    // Create connection  
    $conn = new mysqli($servername, $username, $password, $db);
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
        
    }
    $sql = "SELECT * FROM evenement WHERE etat = 'terminer'";
    $result = $conn->query($sql);
    $sql2 = "SELECT * FROM evenement WHERE etat = 'en cours'";
    $result2 = $conn->query($sql2);
    $sql3 = "SELECT * FROM evenement WHERE etat = 'a venir'";
    $result3 = $conn->query($sql3);



}

?>
<!-- affichage des ellement -->

<!-- affichage des ellement -->
<div class="container-fluid">
<div class="row col-12">

<button class="accordion">terminer</button>
<div class="panel">
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
</div>

<button class="accordion">En cours</button>
<div class="panel">
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
if($result2->num_rows > 0 ){
    while($row2 = $result2->fetch_assoc()){
?> 
<tr >
            <td class="tdList"><?php echo $row2["id"] ?></td>
            <td class="tdList"><?php echo $row2["nom"] ?></td>
            <td class="tdList"><?php echo $row2["description"]?></td>
            <td class="tdList"><?php echo $row2["date"] ?></td>
            <td class="tdList"><?php echo $row2["lieu"] ?></td>
            <td class="tdList">
           <?php $sql22 = 'SELECT nom,code
FROM departement
WHERE id IN (
SELECT id_departement
FROM evenement_dept
WHERE id_Evenement =' . $row2["id"] . ')';
    $result22 = $conn->query($sql22);
    if($result22->num_rows > 0 ){
        while($row22 = $result22->fetch_assoc()){
            ?>
            <?php
     echo $row22["code" ]." ".$row22["nom" ]."<br>";
       }
    }
        ?></td>
     
     
    
    
            <td class="tdList" ><?php echo $row2["etat"] ?></td>
            <td class="tdlist"><a href="modifier.php?id=<?php echo $row2["id"] ?>">🛠️</a></td>
            <td class="tdlist"><a href="supprimer.php?id=<?php echo $row2["id"] ?>">❌</a></td>
        </tr>
        
        <?php
    }
}
?>
</table>
</div>


<button class="accordion">A venir</button>
<div class="panel">
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
if($result3->num_rows > 0 ){
    while($row3 = $result3->fetch_assoc()){
?> 
<tr >
            <td class="tdList"><?php echo $row3["id"] ?></td>
            <td class="tdList"><?php echo $row3["nom"] ?></td>
            <td class="tdList"><?php echo $row3["description"]?></td>
            <td class="tdList"><?php echo $row3["date"] ?></td>
            <td class="tdList"><?php echo $row3["lieu"] ?></td>
            <td class="tdList">
           <?php $sql33 = 'SELECT nom,code
FROM departement
WHERE id IN (
SELECT id_departement
FROM evenement_dept
WHERE id_Evenement =' . $row3["id"] . ')';
    $result33 = $conn->query($sql33);
    if($result33->num_rows > 0 ){
        while($row33 = $result33->fetch_assoc()){
            ?>
            <?php
     echo $row33["code" ]." ".$row33["nom" ]."<br>";
       }
    }
        ?></td>
     
     
    
    
            <td class="tdList" ><?php echo $row3["etat"] ?></td>
            <td class="tdlist"><a href="modifier.php?id=<?php echo $row3["id"] ?>">🛠️</a></td>
            <td class="tdlist"><a href="supprimer.php?id=<?php echo $row3["id"] ?>">❌</a></td>
            <td class="tdlist"><a href="evenementEnCoursEtu.php?id=<?php echo $row["id"]?>" >commencer</a></td>
        </tr>
        
        <?php
    }
}
?>
</table>
</div>


 
    
   


<a class="creeEvents" href="creerEvenement.php">Créer un événement</a>
</div>

<script>

</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="script.js"></script>
</body>
</html>