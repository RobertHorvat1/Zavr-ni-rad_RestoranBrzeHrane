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
        <h1 id="novo">Svi korisnici</h1>
        <?php
            require_once('spoj.php');
            $db_handle = new DBController();
            if (!isset($_GET['page'])) {
                $page = 1;
            }else{
                $page = $_GET['page'];
            }
            $num_per_page=5;
            $start_from = ($page - 1)*5;
            $statistikaSviKorisnici = $db_handle->runQuery("SELECT `Statistika`, `Potrosnja`, `Korisnicko_ime` FROM `korisnik` LIMIT $start_from, $num_per_page");
            if(mysqli_query($conn, $statistikaSviKorisnici)) {
                $statistikaSviKorisniciArray = array('Statistika'=>$statistikaSviKorisnici[0]["Statistika"], 'Potrosnja'=>$statistikaSviKorisnici[0]["Potrosnja"], 'Korisnicko_ime'=>$statistikaSviKorisnici[0]["Korisnicko_ime"]);
        }
        if (!empty($statistikaSviKorisnici)) { 
            foreach($statistikaSviKorisnici as $key=>$value){
        ?>
        <div id="table-narudzba">
        <p></p>
        <table class="tbl-narudzba" style="width:100%" cellpadding="4" cellspacing="4">
            <tr>
                <th>Korisničko ime:</th>
                <td><?php echo $statistikaSviKorisnici[$key]["Korisnicko_ime"]; ?></td>
            </tr>
            <tr>
                <th>Ukupno narudžbi:</th>
                <td><?php echo $statistikaSviKorisnici[$key]["Statistika"]; ?></td>
            </tr>
            <tr>
                <th>Ukupna potrošnja:</th>
                <td><?php echo $statistikaSviKorisnici[$key]["Potrosnja"]; ?></td>
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
        <?php
        $page_query = "SELECT * FROM `korisnik`";
        $page_result = mysqli_query($conn, $page_query);
        $total_record = mysqli_num_rows($page_result);
        $total_page=ceil($total_record/$num_per_page);

        echo "<div id='pagging'>";
        if($page>1){
            echo "<a href='narudžba.php?page=".($page-1)."' class='btn btn-danger'>Nazad</a>";
        }

        for($i=1; $i<$total_page; $i++){
            echo "<a href='narudžba.php?page=".$i."' class='btn btn-primary'>$i</a>";
        }

        if($i>$page){
            echo "<a href='narudžba.php?page=".($page+1)."' class='btn btn-danger'>Naprijed</a>";
        }
        echo "</div>";
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