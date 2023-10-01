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
    <?php
$_SESSION['id2'] = $_GET['id'];
$id2 = $_SESSION['id2'];
?>
    <div class="container">
        <h1 class="titreEvenCour">VOTE ÉTUDIANT <?php echo $id2 ?> </h1>
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



    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "post">
    <div class="container vote">
        <img src="images/green.jpg"  class="imgVoteE voteE1" >
       <img src="images/yellow.jpg"  class="imgVoteE voteE2" >
         <img src="images/red.jpg"  class="imgVoteE voteE3"  > 
    </div>
    </form>
    <?php
}
?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="script.js"></script>
</body>
</html>