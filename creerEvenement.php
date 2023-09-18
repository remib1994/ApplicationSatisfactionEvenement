<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    
if($_SERVER['REQUEST_METHOD'] != "POST" || $erreur == true){
    echo "<h1>LISTE DES EVENEMENTS</h1>";
   
    ?>
<div class="container-fluid">
<div class="row col-12">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    nom de l'evenement : <input type="text" name="nomE"  value="<?php echo $nomEvent;?>">
    <p style="color:red;"><?php echo $nomEventErr; ?></p>
    description de l'evenement : <input type="text" name="descE"  value="<?php echo $descEvent;?>">
    <p style="color:red;"><?php echo $descEventErr; ?></p>
    date de l'evenement : <input type="date" name="dateE"  value="<?php echo $dateEvent;?>">
    <p style="color:red;"><?php echo $dateEventErr; ?></p>
    lieu de l'evenement : <input type="text" name="lieuE"  value="<?php echo $lieuEvent;?>">
    <p style="color:red;"><?php echo $lieuEventErr; ?></p>
        <input type="submit" value="Créer l'événement">
    </form>
        </div>
    </div>
    <?php
   }

?>

</body>
</html>