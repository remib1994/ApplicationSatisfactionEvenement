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
<body class="bodyEtu">
    
    <div class="container">
        <h1 class="titreEvenCour">VOTE ÉTUDIANT  </h1>
    </div>
    <?php
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
    
    $sql = "SELECT * FROM evenement WHERE id = id2";
    $result = $conn->query($sql);
    if(isset($_GET['id'])){
        if(isset($_GET['ajout'])){
            switch($_GET['ajout']){
                case 1:
                    $idEvenement = $_GET['id'];
                    $sqlGet = "UPDATE evenement set Good = (1+ Good) where id =$idEvenement ";
                    $result = $conn->query($sqlGet);
                    break;
                case 2:
                    $idEvenement = $_GET['id'];
                    $sqlGet = "UPDATE evenement set Ok = (1+ Ok) where id =$idEvenement ";
                    $result = $conn->query($sqlGet);
                    break;
                case 3:
                    $idEvenement = $_GET['id'];
                    $sqlGet = "UPDATE evenement set Bad = (1+ Bad) where id =$idEvenement ";
                    $result = $conn->query($sqlGet);
                    break;
            }
        }
    }


    ?>
    <div class="container vote">
       <a href="evenementEnCoursEtu.php?id=<?php echo $_GET['id'] ?>&ajout=1"> <img src="images/green.jpg"  class="imgVoteE " ></a>
       <a href="evenementEnCoursEtu.php?id=<?php echo $_GET['id'] ?>&ajout=2"> <img src="images/yellow.jpg"  class="imgVoteE " ></a>
         <a href="evenementEnCoursEtu.php?id=<?php echo $_GET['id'] ?>&ajout=3"> <img src="images/red.jpg"  class="imgVoteE " ></a>  
    </div>
    
    <?php
}
?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="script.js"></script>
</body>
</html>