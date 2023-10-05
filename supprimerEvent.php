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
 $idEvenement = $_GET['id'];
 $sql = "SELECT * FROM evenement where id = $idEvenement";
    $result = $conn->query($sql);
    $conn->set_charset("utf8");
    
    ?>

    <div class="container">
      <h1 class="titrePage" >Delete Account</h1>
      <p>Are you sure you want to delete your account?</p>
      
      <div class="clearfix">
        <button type="button"  class="cancelbtn" href="index.php" >Cancel</button>
        <button type="button"  class="deletebtn" onclick='window.location.href="index.php?id=<?php echo $_GET["id"]?>&choix=3"'  >Delete</button>
      </div>
    </div>
  

   

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="script.js"></script>
</body>
</html>