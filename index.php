
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="style.css" />

    <title>Gestionnaire évènement</title>
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password = sha1($password,false);
        $email = trojan($email);
        $password = trojan($password);
    }
    $sql = "SELECT * FROM evenement WHERE etat = 'terminer'";
    $result = $conn->query($sql);
    $sql2 = "SELECT * FROM evenement WHERE etat = 'en cours'";
    $result2 = $conn->query($sql2);
    $sql3 = "SELECT * FROM evenement WHERE etat = 'a venir'";
    $result3 = $conn->query($sql3);



}
?>
    <?php
    if(!isset($_SESSION["connexion"]) or $_SESSION["connexion"] != true){ ?>
        <nav class="navbar navbar-dark navbar-expand-lg bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand mx-2" href="index.php">
                    <i class="bi bi-speedometer"></i>SatisfactoPoll
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarScroll">

<!-- affichage des ellement -->
                    <a class="btn btn-outline-warning btn-primary" href="index.php" role="button">Se connecter <i class="bi bi-box-arrow-left"></i></a>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-3">
                    <h1>Connexion</h1>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <div class="mb-3">
                            <label for="email" class="form-label">Adresse email</label>
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text">Nous ne partagerons jamais votre email avec qui que ce soit.</div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <button type="submit" class="btn btn-primary">Se connecter</button>
                    </form>
                </div>
            </div>
        </div>
    <?php
    }else{ ?>

        <nav class="navbar navbar-dark navbar-expand-lg bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand mx-2" href="index.php">
                    <i class="bi bi-speedometer"></i>SatisfactoPoll
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarScroll">
                    <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Évènement
                            </a>
                            <ul class="dropdown-menu">
                                <?php
                                if($_SESSION["admin"] == 1){
                                    echo "<li><a class='dropdown-item' href='creerEvenement.php'>Créer</a></li>";
                                    echo "<li><hr class='dropdown-divider'></li>";
                                }
                                ?>
                                <li><a class="dropdown-item" href="index.php">Afficher</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Département
                            </a>
                            <ul class="dropdown-menu">
                                <?php
                                if($_SESSION["admin"] == 1){
                                    echo "<li><a class='dropdown-item' href='departementCreer.php'>Créer</a></li>";
                                    echo "<li><hr class='dropdown-divider'></li>";
                                }
                                ?>
                                <li><a class="dropdown-item" href="departementAfficher.php">Afficher</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Utilisateur
                            </a>
                            <ul class="dropdown-menu">
                                <?php
                                if($_SESSION["admin"] == 1){
                                    echo "<li><a class='dropdown-item' href='userCreer.php'>Créer</a></li>";
                                    echo "<li><hr class='dropdown-divider'></li>";
                                }
                                ?>
                                <li><a class="dropdown-item" href="userAfficher.php">Afficher</a></li>
                            </ul>
                        </li>
                    </ul>
                        <span class="mx-2 navbar-text">
                            Bienvenue <a class='text-warning' href='userModifier.php?id=<?php echo $_SESSION['id']; ?>'><?php echo $_SESSION["username"]; ?>
                            </a>
                        </span>
                        <a href="deconnecter.php" class="mx-2 link-warning">Se déconnecter <i class="bi bi-box-arrow-right"></i></a>
                </div>

            </div>
        </nav>
    <?php
    } ?>

<!-- INSÉRER LE CODE de Tristan -->


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
</div>
<?php
//function to remove special characters and spaces
function trojan($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data,ENT_QUOTES);
    return $data; ?>
<script>

</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="script.js"></script>

$conn->close();
?>
</body>
</html>