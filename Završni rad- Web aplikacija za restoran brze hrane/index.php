<?php
// Start the session
session_start();
include 'statstika.php';
require('spoj.php');
require('spojZaPrijavuReg.php');
statistikaUkupnoUkupnoPosjetaWebStraniciiUnos($conn);
statistikaUkupnoZaradaUnos($conn);
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
                    <a class="btn btn-primary btn-lg" href="kontakt.php" role="button">Kontakt</a>
                </ul>
            </div>
        </nav>
    </div>
    <div id="hhh" class="container-fluid">
            <h1 id="novo">Dobro došli u restoran brze hrane Feast the beast !!!!</h1>
            <?php
            if(isset($_SESSION['Korisnicko_ime'])){
                echo "Pozdrav: {$_SESSION['Korisnicko_ime']}";
            }
            ?>
            <section>
                <p id="tekst1">U našem restoranu imate raznovrstan izbor brze hrane poput hamburgera, cheezburgera, chikenburgera, raznih tortilja i kebaba. </p>
                <p id="tekst1">Isto tako imate potpuni pregled u naš jelovnik na našoj web stranici. Ako nešto želite naručiti putem naše web stranice možete se prijaviti ovdje. Ako niste registrirani možete se registrirati ovdje.</p>
                <p id="tekst1">Imati  će te mogućnost ocjene hrane i usluge, te isto tako će te moći dati komentar na našu hranu i uslugu.  Bitno nam je zadovoljstvo korisnika, te ćemo gledati da našu uslugu uvijek unaprijedimo.</p>
            </section>
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

