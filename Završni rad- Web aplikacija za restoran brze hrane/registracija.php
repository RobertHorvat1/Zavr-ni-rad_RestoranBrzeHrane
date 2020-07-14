<?php
// Start the session
session_start();
include 'statstika.php';
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
    <script type="text/javascript" id="RHorvat">
        function email() {
            var e_mail = document.forms["forma"]["email"].value;
            var pozicijaEt = e_mail.indexOf("@");
            if (pozicijaEt == -1) {
                alert("E-mail adresa nema znaka \"@\"!");
                return false;
            }
            duljinaPrijeEt = e_mail.slice(0, pozicijaEt).length;
            if (duljinaPrijeEt < 2) {
                alert("E-mail prekratak - moraju biti minimalno dva znaka prije \"@\"!");
                return false;
            }
            var pozicijaTocke = e_mail.indexOf(".", pozicijaEt);
            if (pozicijaTocke == -1) {
                alert("E-mail adresa nema znaka tocku nakon \"@\"!");
                return false;
            }
            if (pozicijaTocke - pozicijaEt < 3) {
                alert("E-mail prekratak - moraju postojati najmanje dva znaka izmedju \"@\" i tocke!");
                return false;
            }
            duljinaNakonTocke = e_mail.slice(pozicijaTocke).length;
            if (duljinaNakonTocke < 3) {
                alert("E-mail adresa mora imati barem dva znaka nakon tocke!");
                return false;
            }
            return true;
        }
    </script>
    
</head>

<body>
<div id="container">
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
                </ul>
            </div>
        </nav>
    </div>
    <?php
    require('spojZaPrijavuReg.php');

    if(isset($_REQUEST['Korisnicko_ime'])){

        $Ime = stripslashes($_REQUEST['Ime']);
        $Ime = mysqli_real_escape_string($conn, $Ime);

        $Prezime = stripslashes($_REQUEST['Prezime']);
        $Prezime = mysqli_real_escape_string($conn, $Prezime);

        $Korisnicko_ime = stripslashes($_REQUEST['Korisnicko_ime']);
        $Korisnicko_ime = mysqli_real_escape_string($conn, $Korisnicko_ime);

        $Email = stripslashes($_REQUEST['Email']);
        $Email = mysqli_real_escape_string($conn, $Email);

        $Lozinka = stripslashes($_REQUEST['Lozinka']);
        $Lozinka = mysqli_real_escape_string($conn, $Lozinka);

        $query = "INSERT into korisnik (Ime, Prezime, Korisnicko_ime, Email, Lozinka) VALUES ('$Ime', '$Prezime', '$Korisnicko_ime', '$Email', '$Lozinka')";
        $result = mysqli_query($conn, $query);
        if($result==true){
            $Korisnik_id =  $conn->insert_id;
        }
        if($result){
            statistikaUkupnoKorisnikaUnos($conn);
            echo "<div class = 'form'>
            <h3>Uspješno si se registrirao.</h3>
            <br/>Click here to <a href='prijava.php'>Prijava</a></div>";
        }
    }else{
    ?>
    <div class="container">
        <h1>Registracija</h1>
        <div id="login-form">
           <form method="post" name="forma"  autocomplete="off">
            <table>
                <div class="form-group">
                    <div class="input-group">
                        <label for="name">Ime : </label>
                        <input type="text" name="Ime"  id = "kor_ime" class="form-control" placeholder="Unesite korisnicko ime" maxlength="40" required />
                    </div>   
                 </div>

                 <div class="form-group">
                    <div class="input-group">
                        <label for="name">Prezime : </label>
                        <input type="text" name="Prezime"  id = "kor_ime" class="form-control" placeholder="Unesite korisnicko ime" maxlength="40" required />
                    </div>   
                 </div>

                 <div class="form-group">
                    <div class="input-group">
                        <label for="name">Korisničko ime : </label>
                        <input type="text" name="Korisnicko_ime"  id = "kor_ime" class="form-control" placeholder="Unesite korisnicko ime" maxlength="40" required />
                    </div>   
                 </div>

                 <div class="form-group">
                    <div class="input-group">
                        <label for="name">E-mail : </label>
                        <input type="email" name="Email" class="form-control" placeholder="Unesite Email" maxlength="40" required/>    
                    </div>   
                </div>
            
                 <div class="form-group">
                    <div class="input-group">
                        <label for="name">Lozinka : </label>
                        <input type="password" name="Lozinka" class="form-control" placeholder="Unesite lozinku" maxlength="15"  required/>
                    </div>    
                </div>
  			
                <div class="form-group">
                    <hr />
                </div>
            
                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-primary" name="btn-signup">Sign Up</button>
                </div>
            </table>
                <div class="form-group">
                    <hr />
                </div>
            
                <div class="form-group">
                     <a href="prijava.php">Prijavi se ovdje.</a>
                </div>
            
          </form>
        </div> 
    </div>
    <?php } ?>
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