<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css" /> 
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