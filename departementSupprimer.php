
<?php
session_start();

    $id="";
    $servername = "cours.cegep3r.info";
    $username = "1238823";
    $password = "1238823";
    $dbname = "1238823-remi-berneche";

    if($_SESSION["admin"] == 1) {
        if(!empty($_GET['id'])){
            $id = $_GET['id'];
            //create connection
            $conn = new mysqli($servername,$username,$password,$dbname);
            // Check connection
            if ($conn->connect_error){
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "DELETE FROM `departement` WHERE `departement`.`id` = $id";


            if($conn->query($sql) == TRUE){
                $etat = true;
                header("Location: departementAfficher.php?etat=$etat");
            }else {
                echo "Erreur";

            }
        }
    }else {
        echo "<h1>Vous devez être administrateur pour voir cette page.</h1>";
    }


    $conn->close();


?>