<?php
session_start();
include 'spojZaPrijavuReg.php';
include 'statstika.php';
$Ukupna_cijena = 0;
$Adresa=null;
if(isset($_SESSION['Korisnicko_ime'])){
    $Korisnicko_ime=$_SESSION['Korisnicko_ime'];
    $Korisnik_id=$_SESSION['Korisnik_id'];
    $Uloga=$_SESSION['Uloga'];
}
?>
<?php
require_once('spoj.php');
$db_handle = new DBController();
if(!empty($_GET["action"])) {
    switch($_GET["action"]) {
        case "add":
            if(!empty($_POST["quantity"])) {
                $productByID = $db_handle->runQuery("SELECT * FROM jelovnik WHERE ID ='".$_GET["ID"]."'");
                $itemArray = array($productByID[0]["ID"]=>array('Naziv_jela'=>$productByID[0]["Naziv_jela"], 'ID'=>$productByID[0]["ID"], 'quantity'=>$_POST["quantity"], 'Kategorija'=>$productByID[0]["Kategorija"], 'Cijena'=>$productByID[0]["Cijena"]));
                if(!empty($_SESSION["cart_item"])) {
                    if(in_array($productByID[0]["ID"],array_keys($_SESSION["cart_item"]))) {
                        foreach($_SESSION["cart_item"] as $k => $v) {
                            if($productByID[0]["ID"] == $k) {
                                if(empty($_SESSION["cart_item"][$k]["quantity"])) {
                                    $_SESSION["cart_item"][$k]["quantity"] = 0;
								}
                                $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
                            }
                        }
                    }else{
                        $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
                    }
                }else{
                    $_SESSION["cart_item"] = $itemArray;
                }
            }
        break;
        case "remove":
            if(isset($_POST['index_to_remove']) && $_POST['index_to_remove'] != ""){
                $key_to_remove = $_POST['index_to_remove'];
                if(count($_SESSION["cart_item"]) <= 1){
                    unset($_SESSION["cart_item"]);
                }else{
                    unset($_SESSION["cart_item"]["$key_to_remove"]);
                    sort($_SESSION["cart_item"]);
                }
            }
        break;
        case "empty":
            unset($_SESSION["cart_item"]);        
        break;	
    }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Restoran Feast the beast</title>
        <link rel="stylesheet"  type="text/css" href="stil1.css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <div id = "naslovni_dio" class = "container-fluid">
            <h1 id="naslov">Restoran Feast the beast</h1>
            <?php
            if(isset($_SESSION['Korisnicko_ime'])){
                echo "<a class='btn btn-primary btn' id ='btn2' href='odjava.php' role='button'>Odjava</a>";
                echo "<a class='btn btn-primary btn' id ='btn2' href='profil.php' role='button'>Profil</a>";
                echo "<p id ='btn2'>{$_SESSION['Korisnicko_ime']}<p>";
            }
        ?>
        </div>
        <style>
        body {
            background-color: #d6ffb7;
        }
    </style>
    <script>
        function myFunction1() {
           document.getElementById("myDropdown1").classList.toggle("show");
        }
        function myFunction2() {
            document.getElementById("myDropdown2").classList.toggle("show");
        }
        function myFunction3() {
            document.getElementById("myDropdown3").classList.toggle("show");
        }
        function myFunction4() {
            document.getElementById("myDropdown4").classList.toggle("show");
        }
        function myFunction5() {
            document.getElementById("myDropdown5").classList.toggle("show");
        }
    </script>
    </head>

<body>
    <div class = "row">
        <nav class="navbar navbar-light bg-light">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">Feast the beast</a>
                </div>
                <ul class="nav navbar-nav">
                    <a class="btn btn-primary btn-lg" href="index.php" role="button">Početna</a>
                    <a class="btn btn-primary btn-lg" href="jelovnik.php" role="button">Jelovnik</a>
                    <?php
                        if(isset($_SESSION['Korisnicko_ime'])){
                    ?>
                    <a class="btn btn-primary btn-lg" href="narudžba.php" role="button">Narudžba</a>
                    <?php
                        }
                    ?>
                    <a class="btn btn-primary btn-lg" href="prijava.php" role="button">Prijava</a>
                    <a class="btn btn-primary btn-lg" href="registracija.php" role="button">Registracija</a>
                    <a class="btn btn-primary btn-lg" href="forum.php" role="button">Forum</a>
                    <a class="btn btn-primary btn-lg" href="o_nama.php" role="button">O nama</a>
                    <a class="btn btn-primary btn-lg" href="kontakt.php" role="button">Kontakt</a>
                </ul>
            </div>
        </nav>
    </div>
    <div class = "container-fluid">
        <div class="dropdown">
            <button onclick="myFunction1()" class="dropbtn">Burgeri</button>
            <div id="myDropdown1" class="dropdown-content">
                <ul class="list-group">
                    <?php
	                    $product_array1 = $db_handle->runQuery("SELECT * FROM `jelovnik` WHERE `Kategorija` = 'Burgeri'");
	                    if (!empty($product_array1)) { 
		                    foreach($product_array1 as $key=>$value){
	                ?>
                    <li class="list-group-item">
                    <form method="post" action="jelovnik.php?action=add&ID=<?php echo $product_array1[$key]["ID"]; ?>">
                    <?php echo $product_array1[$key]["Naziv_jela"]; ?><?php unset($_SESSION["Naziv_jela"]); $_SESSION['Naziv_jela']=$product_array1[$key]["Naziv_jela"]; ?></a>..........<?php echo $product_array1[$key]["Cijena"]."kn"; ?>
                    <?php
                    if(isset($_SESSION['Korisnicko_ime'])){
                        echo " <div class='cart-action'><input type='text' class='product-quantity' name='quantity' value='1' size='2' /><form action='jelovnik2.php?action=add' method='post'><input name='addBtn' type='submit' value='Dodaj'></form></div>";
                     }
                    ?>
                    
                    </li>
                </ul>
                    <?php
		                }
	                }
	                ?>
            </div>
        </div>
        <div class="dropdown">
            <button onClick="myFunction2()" class="dropbtn">Tortilje i kebabi</button>
            <div id="myDropdown2" class="dropdown-content">
                <ul class="list-group">
                    <?php
	                    $product_array1 = $db_handle->runQuery("SELECT * FROM `jelovnik` WHERE `Kategorija` = 'Tortilje i kebabi'");
	                    if (!empty($product_array1)) { 
		                    foreach($product_array1 as $key=>$value){
	                ?>
                    <li class="list-group-item">
                    <form method="post" action="jelovnik.php?action=add&ID=<?php echo $product_array1[$key]["ID"]; ?>">
                   <?php echo $product_array1[$key]["Naziv_jela"]; ?>..........<?php echo $product_array1[$key]["Cijena"]."kn"; ?>
                    <?php
                    if(isset($_SESSION['Korisnicko_ime'])){
                        echo " <div class='cart-action'><input type='text' class='product-quantity' name='quantity' value='1' size='2' /><form action='jelovnik2.php?action=add' method='post'><input name='addBtn' type='submit' value='Add'></form></div>";
                     }
                    ?></li>
                </ul>
                    <?php
		                }
	                }
	                ?>
            </div>
        </div>
        <div class="dropdown">
            <button onClick="myFunction3()" class="dropbtn">Prilozi</button>
            <div id="myDropdown3" class="dropdown-content">
                <ul class="list-group">
                    <?php
	                    $product_array1 = $db_handle->runQuery("SELECT * FROM `jelovnik` WHERE `Kategorija` = 'Prilozi'");
	                    if (!empty($product_array1)) { 
		                    foreach($product_array1 as $key=>$value){
	                ?>
                    <li class="list-group-item">
                    <form method="post" action="jelovnik.php?action=add&ID=<?php echo $product_array1[$key]["ID"]; ?>">
                    <?php echo $product_array1[$key]["Naziv_jela"]; ?>..........<?php echo $product_array1[$key]["Cijena"]."kn"; ?>
                    <?php
                    if(isset($_SESSION['Korisnicko_ime'])){
                        echo " <div class='cart-action'><input type='text' class='product-quantity' name='quantity' value='1' size='2' /><form action='jelovnik2.php?action=add' method='post'><input name='addBtn' type='submit' value='Add'></form></div>";
                     }
                    ?></li>
                </ul>
                    <?php
		                }
	                }
	                ?>
            </div>
        </div>
        

        <div class="dropdown">
            <button onClick="myFunction4()" class="dropbtn">Ostalo</button>
            <div id="myDropdown4" class="dropdown-content">
                <ul class="list-group">
                    <?php
	                    $product_array1 = $db_handle->runQuery("SELECT * FROM `jelovnik` WHERE `Kategorija` = 'Ostalo'");
	                    if (!empty($product_array1)) { 
		                    foreach($product_array1 as $key=>$value){
	                ?>
                    <li class="list-group-item">
                    <form method="post" action="jelovnik.php?action=add&ID=<?php echo $product_array1[$key]["ID"]; ?>">
                    <?php echo $product_array1[$key]["Naziv_jela"]; ?><?php echo $product_array1[$key]["Cijena"]."kn"; ?>
                    <?php
                    if(isset($_SESSION['Korisnicko_ime'])){
                        echo " <div class='cart-action'><input type='text' class='product-quantity' name='quantity' value='1' size='2' /><form action='jelovnik2.php?action=add' method='post'><input name='addBtn' type='submit' value='Add'></form></div>";
                     }
                    ?></li>
                </ul>
                    <?php
		                }
	                }
	                ?>
            </div>
        </div>
        <div class="dropdown">
            <button onClick="myFunction5()" class="dropbtn">Pica</button>
            <div id="myDropdown5" class="dropdown-content">
                <ul class="list-group">
                    <?php
	                    $product_array1 = $db_handle->runQuery("SELECT * FROM `jelovnik` WHERE `Kategorija` = 'Pica'");
	                    if (!empty($product_array1)) { 
		                    foreach($product_array1 as $key=>$value){
	                ?>
                    <li class="list-group-item">
                    <form method="post" action="jelovnik.php?action=add&ID=<?php echo $product_array1[$key]["ID"]; ?>">
                    <?php echo $product_array1[$key]["Naziv_jela"]; ?>..........<?php echo $product_array1[$key]["Cijena"]."kn"; ?>
                    <?php
                    if(isset($_SESSION['Korisnicko_ime'])){
                        echo " <div class='cart-action'><input type='text' class='product-quantity' name='quantity' value='1' size='2' /><form action='jelovnik2.php?action=add' method='post'><input name='addBtn' type='submit' value='Add'></form></div>";
                    }
                    ?>
                    </li>
                </ul>
                    <?php
		                }
	                }
	                ?>
            </div>
        </div>
    </div>
    <?php
    require ('spojZaPrijavuReg.php');
    
    if(isset($_POST['Adresa'])){
        $Ukupna_cijena = 0;
        $Korisnik_id=$_SESSION['Korisnik_id'];
        $Korisnicko_ime=$_SESSION['Korisnicko_ime'];
        $Adresa = htmlspecialchars($_POST['Adresa']);
        $Adresa = mysqli_real_escape_string($conn, $Adresa);
        $Ukupna_cijena = $_POST['Ukupna_cijena'];
        $Detalji_narudzbe = htmlspecialchars($_POST['Detalji_narudzbe']);
        $Detalji_narudzbe = stripslashes($_POST['Detalji_narudzbe']);
        $Detalji_narudzbe = mysqli_real_escape_string($conn,$Detalji_narudzbe);
        $queryJelo1 = "SELECT Narudzba_jela FROM statistika";
        $rezultat = $conn->query($queryJelo1);
        if(mysqli_query($conn, $queryJelo1)) {
            while($row = $rezultat->fetch_assoc()){   
                $Narudzba_jela1 = $row['Narudzba_jela'];
            }
        }
        $Narudzba_jela = htmlspecialchars($_POST['Narudzba_jela']);
        $Narudzba_jela = stripslashes($_POST['Narudzba_jela']);
        $Narudzba_jela = mysqli_real_escape_string($conn,$Narudzba_jela);
        $Narudzba_jela .=$Narudzba_jela1;
        

        $query = "INSERT INTO narudzba (Korisnik_id, Korisnicko_ime, Adresa, Detalji_narudzbe, Ukupna_cijena) VALUES ('$Korisnik_id', '$Korisnicko_ime', '$Adresa', '$Detalji_narudzbe', '$Ukupna_cijena')";
   
        if($conn->query($query) === TRUE){
            unset($_SESSION["cart_item"]);
            statistikaKorisnikNarudzbaUnos($conn, $Korisnicko_ime);
            statistikaUkupnoPotrošnjaKorisnikUnos($conn, $Korisnicko_ime);
            statistikaUkupnoNarudzbiUnos($conn);
            statistikaUkupnoZaradaUnos($conn);
            $queryJelo2="UPDATE statistika SET Narudzba_jela='$Narudzba_jela'";
            $rezJelo = $conn->query($queryJelo2);
            statistikaNajJeloUnos($conn); 
            echo "<div class = 'form'>
            <h3>Uspješno si naručio.</h3>";
        }else{
            echo "Greška";
        }
        
    }else{
    ?>
    <div id="shopping-cart">
    <?php
        if(isset($_SESSION["cart_item"])){
            $total_quantity = 0;
            $Ukupna_cijena = 0;
    ?>
    <div class="txt-heading">Shopping Cart</div>	
    <table class="tbl-cart" cellpadding="10" cellspacing="1">
    <tbody>
    <tr>
        <th style="text-align:left;"><b>Naziv jela</th>
        <th style="text-align:left;"><b>ID</th>
        <th style="text-align:right;" width="5%"><b>Količina</th>
        <th style="text-align:right;" width="10%"><b>Cijena</th>
        <th style="text-align:right;" width="10%"><b>Ukupna cijena </th>
        <th style="text-align:center;" width="5%"><b>Ukloni</th>
    </tr>	
    <?php
        $i=0;	
        $Detalji_narudzbe="";
        $Narudzba_jela="";
        foreach ($_SESSION["cart_item"] as $item){
            $Kolicina = $item["quantity"];
            $Cijena=$item["Cijena"];
            $Cijena_uk = $item["Cijena"];
            $Naziv_jela=$item["Naziv_jela"];
            $Jelo_id=$item["ID"];
            $Cijena_uk = $Kolicina*$Cijena_uk;      
		    ?>
				<tr>
				<td><?php echo "<p id ='btn1' name='Naziv_jela' >{$Naziv_jela}<p>"; ?></td>
				<td><?php echo "<p id ='btn1' name='Jelo_id' >{$Jelo_id}<p>"; ?></td>
				<td style="text-align:right;"><?php echo "<p id ='btn1'  name='Kolicina' >{$Kolicina}<p>"; ?></td>
				<td  style="text-align:right;"><?php echo "<p id ='btn1'  name='Cijena' >{$Cijena} kn <p>"; ?></td>
				<td  style="text-align:right;"><?php echo  number_format($Cijena_uk,2)." kn " ; ?></td>
				<td style="text-align:center;"><form action="jelovnik.php?action=remove" method="post"><input id = "remove" name="deleteBtn <?php echo $item["ID"]; ?>" type="submit" value="Ukloni"><input name="index_to_remove" type="hidden" value="<?php echo $i; ?>"></form></td>
				</tr>
				<?php
                $i++;
				$total_quantity += $Kolicina;
                $Ukupna_cijena += ($Cijena_uk*$Kolicina);
                $Detalji_narudzbe .= nl2br("ID: {$Jelo_id} - Naziv: {$Naziv_jela} - Kolicina: {$Kolicina} - Cijena: {$Cijena} kn - Ukupna cijena jela:{$Cijena_uk} kn \n");
                $Narudzba_jela .= "$Naziv_jela,";                    
        }
        
		?>

        <tr>
            <td colspan="2" alignt="right"><b>Ukupna količina:</td>
            <td alignt="right"><?php echo $total_quantity; ?></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2" alignt="right"><b>Ukupna cijena:</td>
            <td alignt="right" id="ukupno"  colspan="2"><strong><?php echo number_format($Ukupna_cijena, 2)."kn"; ?></strong></td>
            <td></td>
        </tr>
    </tbody>
    </table>
    <br>
    <a id="btnEmpty" class="btn  btn-primary" href="jelovnik.php?action=empty">Isprazni</a>
    <br>
    <div class="form" id="">
        <br>
        <p><b>Unesi adresu:</p>
        <form name="jelovnik2" action="" method="post">
            <input type="text" name="Adresa" id="adresa" placeholder="Adresa" required/>
            <input type="hidden" name="Ukupna_cijena" value="<?php echo $Ukupna_cijena;?>">
            <input type="hidden" name="Detalji_narudzbe" value="<?php echo $Detalji_narudzbe;?>">
            <input type="hidden" name="Narudzba_jela" value="<?php echo $Narudzba_jela;?>">
            <br><br>
            <button type="submit" class="btn  btn-primary" id="naruciBtn" name="action">Naruči</button>
        </form>
        <?php
            } else {
        ?>
    </div>		
<div class="no-records">Your Cart is Empty</div>
<?php } ?>
<?php 
}
?>
<?php
if(isset($_SESSION['Korisnicko_ime'])){
    if($Uloga=="Administrator"){
        echo "<a class='btn btn-primary btn' id ='btn3' href='dodavanje_jela.php' role='button'>Dodaj jelo</a>";
    }
}
?>
</div>
<footer class="section footer-classic context-dark bg-image" style="background: #dfca2c;">
        <div class="container">
          <div class="row row-30">
            <div class="col-md-4 col-xl-5">
              <p><br></p>
              <p>Robert Horvat - FERIT Osijek - Informatika</p>
              <p><br></p>
            </div>
            <div class="col-md-4">
              <h5>Contacts</h5>
              <dl class="contact-list">
                <dt>email1:</dt>
                <dd><a href="mailto:#">robert.horvat9@gmail.com</a></dd>
              </dl>
              <dl class="contact-list">
                <dt>email2:</dt>
                <dd><a href="mailto:#">rhorvat@etfos.hr</a></dd>
              </dl>
            </div>
          </div>
        </div>
        <div class="row no-gutters social-container">
          <div class="col"><a class="social-inner" href="https://www.facebook.com/robert.horvat.146"><span class="icon mdi mdi-facebook"></span><span>Facebook</span></a></div>
          <div class="col"><a class="social-inner" href="https://www.instagram.com/robert.horvat3/"><span class="icon mdi mdi-instagram"></span><span>instagram</span></a></div>
          <p><br></p>
          <p><br></p>
        </div>
      </footer>
</body>
</html>

<?php
function statistikaKorisnikNarudzbaUnos($conn, $Korisnicko_ime){
        $sql1 = "SELECT Statistika FROM korisnik WHERE Korisnicko_ime='$Korisnicko_ime'";
        $rezultat = $conn->query($sql1);
        if(mysqli_query($conn, $sql1)) {
            while($row = $rezultat->fetch_assoc()){   
                $Statistika = $row['Statistika'];
            }
        }
        $Statistika = $Statistika + 1;
        $sql2 = "UPDATE korisnik SET Statistika='$Statistika' WHERE Korisnicko_ime='$Korisnicko_ime'";
        $rez = $conn->query($sql2); 
}





function statistikaUkupnoPotrošnjaKorisnikUnos($conn, $Korisnicko_ime){
    $db_handle = new DBController();
    $ukupni_zbroj=0;
    $zbroj = $db_handle->runQuery("SELECT `Ukupna_cijena` FROM `narudzba` WHERE Korisnicko_ime='$Korisnicko_ime'");
    if($zbroj==TRUE) {
        $zbrojArray = array('Ukupna_cijena'=>$zbroj[0]["Ukupna_cijena"]);
    }else{
        echo "Ne postoji narudžba";
    }
    if (!empty($zbroj)) { 
        foreach($zbroj as $key=>$value){
            $ukupni_zbroj += $zbroj[$key]["Ukupna_cijena"];
        }
    }
    $sql3 = "SELECT Potrosnja FROM korisnik WHERE Korisnicko_ime='$Korisnicko_ime'";
    $rezultat = $conn->query($sql3);
    if(mysqli_query($conn, $sql3)) {
        while($row = $rezultat->fetch_assoc()){   
            $Potrosnja = $row['Potrosnja'];
        }
    }
    $Potrosnja = $Potrosnja + $ukupni_zbroj;
    $sql4 = "UPDATE korisnik SET Potrosnja='$Potrosnja' WHERE Korisnicko_ime='$Korisnicko_ime'";
    $rez = $conn->query($sql4); 

}

function statistikaNajJeloUnos($conn){
    $sql5 = "SELECT Narudzba_jela FROM statistika";
    $rezultat = $conn->query($sql5);
    if(mysqli_query($conn, $sql5)) {
        while($row = $rezultat->fetch_assoc()){   
            $Narudzba_jela = $row['Narudzba_jela'];
        }
    }
    $Narudzba_jela_dijelovi = explode(",", $Narudzba_jela);
    $Najfrekventnija_jela = array_count_values($Narudzba_jela_dijelovi);
    arsort($Najfrekventnija_jela);
    $Naj_jelo = array_slice(array_keys($Najfrekventnija_jela), 0, true);
    $Najvise_narucivano_jelo = implode( $Naj_jelo );
    $sql6 = "UPDATE statistika SET Najvise_narucivano_jelo='$Najvise_narucivano_jelo'";
    $rez = $conn->query($sql6); 
}
?> 