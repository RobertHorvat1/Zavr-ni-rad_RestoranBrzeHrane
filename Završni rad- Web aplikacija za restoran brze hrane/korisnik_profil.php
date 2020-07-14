<?php
session_start();
include 'spojZaPrijavuReg.php';
include 'spoj.php';
if(isset($_SESSION['Korisnicko_ime'])){
    $Korisnicko_ime=$_SESSION['Korisnicko_ime'];
    $Korisnik_id=$_SESSION['Korisnik_id'];
    $Uloga=$_SESSION['Uloga'];
}
	if($Uloga=="Korisnik")
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
<div id="container">
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
        <h1 id="novo">Profil i statistika korisnika</h1>
        <?php
        if(isset($_SESSION['Korisnicko_ime'])){
            echo "Pozdrav: {$_SESSION['Korisnicko_ime']}";
        }
        ?>
        <?php
        $db_handle = new DBController();
        $KorisnikPodatci = $db_handle->runQuery("SELECT `ID`, `Ime`, `Prezime`, `Korisnicko_ime`, `Email`, `Uloga`  FROM `korisnik` WHERE `Korisnicko_ime` = '$Korisnicko_ime'");
        if($KorisnikPodatci==TRUE) {
            $KorisnikPodatciArray = array('ID'=>$KorisnikPodatci[0]["ID"], 'Ime'=>$KorisnikPodatci[0]["Ime"], 'Prezime'=>$KorisnikPodatci[0]["Prezime"], 'Korisnicko_ime'=>$KorisnikPodatci[0]["Korisnicko_ime"], 'Email'=>$KorisnikPodatci[0]["Email"], 'Uloga'=>$KorisnikPodatci[0]["Uloga"]);
        }
        if (!empty($KorisnikPodatci)) { 
            foreach($KorisnikPodatci as $key=>$value){
    ?>  
        <h3>Podatci korisnika</h3>
        <div id="table-narudzba">
        <p></p>
        <table class="tbl-narudzba" style="width:100%" cellpadding="4" cellspacing="4">
            <tr>
                <th>ID:</th>
                <td><?php echo $KorisnikPodatci[$key]["ID"]; ?></td>
            </tr>
            <tr>
                <th>Ime:</th>
                <td><?php echo $KorisnikPodatci[$key]["Ime"]; ?></td>
            </tr>
            <tr>
                <th>Prezime:</th>
                <td><?php echo $KorisnikPodatci[$key]["Prezime"]; ?></td>
            </tr>
            <tr>
                <th>Korisničko ime:</th>
                <td><?php echo $KorisnikPodatci[$key]["Korisnicko_ime"]; ?></td>
            </tr>
            <tr>
                <th>Email:</th>
                <td><?php echo $KorisnikPodatci[$key]["Email"]; ?></td>
            </tr>
            <tr>
                <th>Uloga:</th>
                <td><?php echo $KorisnikPodatci[$key]["Uloga"]; ?></td>
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
        <h3>Statistika korisnika</h3> 
        <?php
        $db_handle = new DBController();
        $statistikaKorisnik = $db_handle->runQuery("SELECT `Statistika`, `Potrosnja` FROM `korisnik` WHERE `Korisnicko_ime` = '$Korisnicko_ime'");
        if($statistikaKorisnik==TRUE) {
            $statistikaKorisnikArray = array('Statistika'=>$statistikaKorisnik[0]["Statistika"], 'Potrosnja'=>$statistikaKorisnik[0]["Potrosnja"]);
        }
        if (!empty($statistikaKorisnik)) { 
            foreach($statistikaKorisnik as $key=>$value){
    ?>  
        <div id="table-narudzba">
        <p></p>
        <table class="tbl-narudzba" style="width:100%" cellpadding="4" cellspacing="4">
            <tr>
                <th>Ukupno narudžbi:</th>
                <td><?php echo $statistikaKorisnik[$key]["Statistika"]; ?></td>
            </tr>
            <tr>
                <th>Ukupna potrošnja:</th>
                <td><?php echo $statistikaKorisnik[$key]["Potrosnja"]; ?></td>
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
            <div class="col-md-4">
                <div class="col"><a class="social-inner" href="https://www.facebook.com/robert.horvat.146"><span class="icon mdi mdi-facebook"></span><span>Facebook</span></a></div>
                <div class="col"><a class="social-inner" href="https://www.instagram.com/robert.horvat3/"><span class="icon mdi mdi-instagram"></span><span>instagram</span></a></div>
            </div>
          </div>
        </div> 
      </footer>
</body>
</html>
<?php
	}
	else
	{
		if($Uloga=="Korisnik")
		{
			header("location:korisnik_profil.php");		
		}
		else{
			header("location:prijava.php");
		}
	}
?>