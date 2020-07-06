<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
include 'spojZaPrijavuReg.php';
include 'spoj.php';
if(isset($_SESSION['Korisnicko_ime'])){
    $Korisnicko_ime=$_SESSION['Korisnicko_ime'];
    $Korisnik_id=$_SESSION['Korisnik_id'];
    $Uloga=$_SESSION['Uloga'];
}
	if($Uloga=="Administrator")
	{
?>

<!DOCTYPE html>
<html>
<head>
    <title id = "title">Restoran Feast the beast</title>
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
    
</head>

<body>
    <div class = "row">
        <nav class="navbar navbar-light bg-light">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">Feast the beast</a>
                </div>
                <ul  class="nav navbar-nav">
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
                </ul>
            </div>
        </nav>
    </div>
    <div id="hhh" class="container-fluid">
        <h1 id="novo">Profil i statistika restorana</h1>
        <?php
        if(isset($_SESSION['Korisnicko_ime'])){
            echo "Pozdrav: {$_SESSION['Korisnicko_ime']}";
        }
        ?>
        <?php
        require_once('spoj.php');
        $db_handle = new DBController();
        $statistikaAdmin = $db_handle->runQuery("SELECT * FROM `statistika`");
        if(mysqli_query($conn, $statistikaAdmin)) {
            $statistikaArray = array('ID'=>$statistikaAdmin[0]["ID"], 'Ukupno_narudzba'=>$statistikaAdmin[0]["Ukupno_narudzba"], 'Ukupno_korisnika'=>$statistikaAdmin[0]["Ukupno_korisnika"], 'Zbroj_zarade'=>$statistikaAdmin[0]["Zbroj_zarade"], 'Ukupno_pogleda_web'=>$statistikaAdmin[0]["Ukupno_pogleda_web"], 'Najvise_narucivano_jelo'=>$statistikaAdmin[0]["Najvise_narucivano_jelo"]);
        }
        if (!empty($statistikaAdmin)) { 
            foreach($statistikaAdmin as $key=>$value){
        ?>
        <div id="table-narudzba">
        <p></p>
        <table class="tbl-narudzba" style="width:100%" cellpadding="4" cellspacing="4">
            <tr>
                <th>ID:</th>
                <td><?php echo $statistikaAdmin[$key]["ID"]; ?></td>
            </tr>
            <tr>
                <th>Ukupno narudžbi:</th>
                <td><?php echo $statistikaAdmin[$key]["Ukupno_narudzba"]; ?></td>
            </tr>
            <tr>
                <th>Ukupno korisnika:</th>
                <td><?php echo $statistikaAdmin[$key]["Ukupno_korisnika"]; ?></td>
            </tr>
            <tr>
                <th>Zbroj ukupne zarade:</th>
                <td><?php echo $statistikaAdmin[$key]["Zbroj_zarade"]; ?></td>
            </tr>
            <tr>
                <th>Ukupni broj pogleda web stranice:</th>
                <td><?php echo $statistikaAdmin[$key]["Ukupno_pogleda_web"]; ?></td>
            </tr>
            <tr>
                <th>Najviše naručivano jelo:</th>
                <td><?php echo $statistikaAdmin[$key]["Najvise_narucivano_jelo"]; ?></td>
            </tr>
        </table>
        <p><br></p>
        </div>
        <?php
		    }
	    }else{
            die("");
        }
	    ?>
        <h3>Korisnik s najviše narudžbi</h3>
       <?php
        require_once('spoj.php');
        $db_handle = new DBController();
        $statistikaKorisnikMaxNarudzbe = $db_handle->runQuery("SELECT MAX(`Statistika`) AS StatistikaMax , MAX(`Korisnicko_ime`) AS Korisnik_ime FROM `korisnik`");
        if(mysqli_query($conn, $statistikaKorisnikMaxNarudzbe)) {
            $statistikaKorisnikMaxNarudzbeArray = array('StatistikaMax'=>$statistikaKorisnikMaxNarudzbe[0]["StatistikaMax"], 'Korisnik_ime'=>$statistikaKorisnikMaxNarudzbe[0]["Korisnik_ime"]);
        }
        if (!empty($statistikaKorisnikMaxNarudzbe)) { 
            foreach($statistikaKorisnikMaxNarudzbe as $key=>$value){
        ?>
        <div id="table-narudzba">
        <p></p>
        <table class="tbl-narudzba" style="width:100%" cellpadding="4" cellspacing="4">
            <tr>
                <th>Korisničko ime:</th>
                <td><?php echo $statistikaKorisnikMaxNarudzbe[$key]["Korisnik_ime"]; ?></td>
            </tr>
            <tr>
                <th>Ukupno narudžbi:</th>
                <td><?php echo $statistikaKorisnikMaxNarudzbe[$key]["StatistikaMax"]; ?></td>
            </tr>
            
        </table>
        <p><br></p>
        </div>
        <?php
		    }
	    }else{
            die("");
        }
	    ?>
        <h3>Korisnik s najvećom potrošnjom</h3>
        <?php
        require_once('spoj.php');
        $db_handle = new DBController();
        $statistikaKorisnikMaxPotrosnjaN = $db_handle->runQuery("SELECT MAX(`Potrosnja`) AS PotrosnjaMax , MAX(`Korisnicko_ime`) AS Korisnik_ime FROM `korisnik`");
        if(mysqli_query($conn, $statistikaKorisnikMaxPotrosnjaN)) {
            $statistikaKorisnikMaxPotrosnjaNArray = array('PotrosnjaMax'=>$statistikaKorisnikMaxPotrosnjaN[0]["PotrosnjaMax"], 'Korisnik_ime'=>$statistikaKorisnikMaxPotrosnjaN[0]["Korisnik_ime"]);
        }
        if (!empty($statistikaKorisnikMaxNarudzbe)) { 
            foreach($statistikaKorisnikMaxNarudzbe as $key=>$value){
        ?>
        <div id="table-narudzba">
        <p></p>
        <table class="tbl-narudzba" style="width:100%" cellpadding="4" cellspacing="4">
            <tr>
                <th>Korisničko ime:</th>
                <td><?php echo $statistikaKorisnikMaxPotrosnjaN[$key]["Korisnik_ime"]; ?></td>
            </tr>
            <tr>
                <th>Ukupna potrošnja:</th>
                <td><?php echo $statistikaKorisnikMaxPotrosnjaN[$key]["PotrosnjaMax"]; ?></td>
            </tr>
            
        </table>
        <p><br></p>
        </div>
        <?php
		    }
	    }else{
            die("");
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
	}else{
		if($Uloga=="Korisnik")
		{
			header("location:korisnik_profil.php");		
		}
		else{
			header("location:prijava.php");
		}
	}
?>