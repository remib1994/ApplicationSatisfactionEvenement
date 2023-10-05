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
 $idEvenement = $_GET['id'];
 $sql = "SELECT * FROM evenement where id = $idEvenement";
    $result = $conn->query($sql);

    $conn->set_charset("utf8");

    ?>

    <div class="container">

      <h1 class="titrePage" >Suppression évenement</h1>

      <p>etes vous certains de vouloire supprimer cette événement?</p>
      
      <div class="clearfix">
        <button type="button"  class="cancelbtn" href="index.php" >Cancel</button>
        <button type="button"  class="deletebtn" onclick='window.location.href="index.php?id=<?php echo $_GET["id"]?>&choix=3"'  >Delete</button>
      </div>
    </div>
  

   

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="script.js"></script>
</body>
</html>