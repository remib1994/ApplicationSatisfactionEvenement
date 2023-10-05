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
    <h1 class="titrePage bg-primary">LISTE DES EVENEMENTS</h1>
    
    <?php
$nomEvent = "";
$nomEventErr = "";
$descEvent = "";
$descEventErr = "";
$dateEvent = "";
$dateEventErr = "";
$lieuEvent = "";
$lieuEventErr = "";
$idEvenement = "";
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

    $conn->set_charset("utf8");

    if(isset($_GET['id'])){
        
        if(isset($_GET['choix'])){
            switch($_GET['choix']){
                case 1:
                    $idEvenement = $_GET['id'];
                    $sqlGet = "UPDATE evenement set etat = 'terminer' where id =$idEvenement ";
                    $result = $conn->query($sqlGet);
                    break;
                case 2:
                    $idEvenement = $_GET['id'];
                    $sqlGet = "UPDATE evenement set etat = 'en cours' where id =$idEvenement ";
                    $result = $conn->query($sqlGet);
                    break;
                case 3:
                    $idEvenement = $_GET['id'];
                    
                    
                            $sqlGet5 = "DELETE FROM evenement_dept where id_Evenement =$idEvenement ";
                            $result5 = $conn->query($sqlGet5);
                        
                    

                    $sqlGet = "DELETE FROM evenement where id =$idEvenement ";
                    $result = $conn->query($sqlGet);

                    break;
                case 4:
                    $idEvenement = $_GET['id'];
                    $sqlGet = "UPDATE evenement set etat = 'a venir' where id =$idEvenement ";
                    $result = $conn->query($sqlGet);
                    break;


            }
           
        }
      
    }
    
    $sql = "SELECT * FROM evenement WHERE etat = 'terminer'";
    $result = $conn->query($sql);
    $sql2 = "SELECT * FROM evenement WHERE etat = 'en cours'";
    $result2 = $conn->query($sql2);
    $sql3 = "SELECT * FROM evenement WHERE etat = 'a venir'";
    $result3 = $conn->query($sql3);
    $conn->set_charset("utf8");


}



?>
<!-- affichage des ellement -->

<!-- affichage des ellement -->
<div class="container-fluid">
<div class="row col-12">

<button class="accordion bg-primary ">terminer</button>
<div class="panel">
<table class="table table-striped table-info"  >
  <tr>
    <th class="tdCat  ">id</th>
    <th class="tdCat  ">nom</th>
    <th class="tdCat  ">description</th>
    <th class="tdCat ">date</th>
    <th class="tdCat">lieu</th>
    <th class="tdCat">departement</th>
    <th class="tdCat">etat</th>
    <th class="tdCat">resultat étudiant</th>
    <th class="tdCat">resultat professeur</th>

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
            <td class="tdlist">
                <label> 😀  : <?php echo $row["Good"] ?> </label> 
                <label> 😑  : <?php echo $row["Ok"] ?> </label>
                <label> ☹️  : <?php echo $row["Bad"] ?> </label>
            </td>
            <td class="tdlist">
                <label> 😀  : <?php echo $row["GoodAdmin"] ?>  </label>
                <label> 😑  : <?php echo $row["OkAdmin"] ?> </label>
                <label> ☹️  : <?php echo $row["BadAdmin"] ?> </label>
            </td>
          </tr>
        
        <?php
    }
}
?>
</table>
</div>

<button class="accordion bg-primary">En cours</button>
<div class="panel">
<table class="table table-striped table-info" >
  <tr>
    <th class="tdCat">id</th>
    <th class="tdCat">nom</th>
    <th class="tdCat">description</th>
    <th class="tdCat">date</th>
    <th class="tdCat">lieu</th>
    <th class="tdCat">departement</th>
    <th class="tdCat">etat</th>
    <th class="tdCat">resultat étudiant</th>
    <th class="tdCat">resultat professeur</th>
    <th class="tdCat">otpion</th>
    <th class="tdCat">action</th>

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
    $conn->set_charset("utf8");
    if($result22->num_rows > 0 ){
        while($row22 = $result22->fetch_assoc()){
            ?>
            <?php
     echo $row22["code" ]." ".$row22["nom" ]."<br>";
       }
    }
        ?></td>
     
     
    
            <td class="tdlist">
                <label> 😀  : <?php echo $row2["Good"] ?> </label> 
                <label> 😑  : <?php echo $row2["Ok"] ?> </label>
                <label> ☹️  : <?php echo $row2["Bad"] ?> </label>
            </td>
            <td class="tdlist">
                <label> 😀  : <?php echo $row2["GoodAdmin"] ?>  </label>
                <label> 😑  : <?php echo $row2["OkAdmin"] ?> </label>
                <label> ☹️  : <?php echo $row2["BadAdmin"] ?> </label>
            </td>
            <td class="tdList" ><?php echo $row2["etat"] ?></td>
            <td class="tdlist"><a href="modifierEvent.php?id=<?php echo $row2["id"] ?>">🛠️</a>
             </td>
            <td class="tdlist"><button class="btn btn-primary" onclick="window.location.href='evenementEnCoursEtu.php?id=<?php echo $row2['id'] ?>'">VOTE ÉTUDIANT</button>
            <button class="btn btn-primary" onclick="window.location.href='evenementEnCourPers.php?id=<?php echo $row2['id'] ?>'">VOTE PROFESSEUR</button>
            <button class="btn btn-primary" onclick="window.location.href='index.php?id=<?php echo $row2['id'] ?>&choix=1'">TERMINER</button>

            <button class="btn btn-primary" onclick="window.location.href='index.php?id=<?php echo $row2['id'] ?>&choix=4'">ANNULER</button>

        </td>

        </tr>
        
        <?php
    }
}
?>
</table>
</div>


<button class="accordion bg-primary">A venir</button>
<div class="panel">
<table class="table table-striped table-info" >
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
            <td class="tdlist"><a href="modifierEvent.php?id=<?php echo $row3["id"] ?>">🛠️</a>
            <a onclick="document.getElementById('id01').style.display='block'" href="supprimerEvent.php?id=<?php echo $row3["id"] ?>" >❌</a></td>

            <td class="tdlist"><button class="btn btn-primary" onclick="window.location.href='index.php?id=<?php echo $row3['id'] ?>&choix=2'">COMMENCER</button></td>
            

        </tr>
        
        <?php
    }
}
?>
</table>
</div>


 
    
   



</div>

<script>

</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="script.js"></script>
</body>
</html>