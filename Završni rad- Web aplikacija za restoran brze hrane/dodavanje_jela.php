<?php
// Start the session
session_start();
require('spoj.php');
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
                    <a class="btn btn-primary btn-lg" href="o_nama.php" role="button">O nama</a>
                    <a class="btn btn-primary btn-lg" href="kontakt.php" role="button">Kontakt</a>
                </ul>
            </div>
        </nav>
    </div>
    <?php
    require('spojZaPrijavuReg.php');

    if(isset($_POST['Naziv_jela'])){

        $Naziv_jela = stripslashes($_REQUEST['Naziv_jela']);
        $Naziv_jela = mysqli_real_escape_string($conn, $Naziv_jela);

        $Kategorija = stripslashes($_REQUEST['Kategorija']);
        $Kategorija = mysqli_real_escape_string($conn, $Kategorija);

        $Cijena = stripslashes($_REQUEST['Cijena']);
        $Cijena = mysqli_real_escape_string($conn, $Cijena);

        $query = "INSERT into jelovnik (Naziv_jela, Kategorija, Cijena) VALUES ('$Naziv_jela', '$Kategorija', '$Cijena')";
        $result = mysqli_query($conn, $query);
        if($result){
            echo "<div class = 'form'>
            <h3>Uspješno si postavio jelo.</h3>
            </div>";
        }
    }else{
    ?>
    <div id="hhh" class="container-fluid">
        <div class="form">
            <form name="jelovnik2" action="" method="post">
                <label for="Naziv_jela">Naziv jela: </label>
                <input type="text" name="Naziv_jela" placeholder="Naziv_jela" required/>
                <br>
                <label for="Kategorija">Kategorija: </label>
                <select id="Kategorija" name="Kategorija">
                    <option value="Burgeri">Burgeri</option>
                    <option value="Tortilje i kebabi">Tortilje i kebabi</option>
                    <option value="Prilozi">Prilozi</option>
                    <option value="Ostalo">Ostalo</option>
                    <option value="Pica">Pića</option>
                </select>
                <br>
                <label for="Cijena">Cijena: </label>
                <input type="number" name="Cijena" value="">
                <br>
                <button type="submit" class="btn btn-block btn-primary" name="action">Naruči</button>
            </form>
        </div>	
    </div>
    <?php } ?>
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