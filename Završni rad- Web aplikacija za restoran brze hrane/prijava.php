<?php
// Start the session
session_start();
require('spojZaPrijavuReg.php');
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
    $error = "";
    
    if(isset($_POST['Korisnicko_ime'])){

        $success=false;

        $Korisnicko_ime = stripslashes($_REQUEST['Korisnicko_ime']);
        $Korisnicko_ime = mysqli_real_escape_string($conn,$Korisnicko_ime);
        $Lozinka = stripslashes($_REQUEST['Lozinka']);
        $Lozinka = mysqli_real_escape_string($conn,$Lozinka);

        $result = mysqli_query($conn, "SELECT * FROM korisnik WHERE Korisnicko_ime='$Korisnicko_ime' and Lozinka='$Lozinka' and Uloga='Administrator';");
        $rows = mysqli_num_rows($result);

        while($row = mysqli_fetch_array($result)){
	        $success = true;
	        $Korisnik_id = $row['ID'];
            $Uloga= $row['Uloga'];
            $Korisnicko_ime = $row['Korisnicko_ime'];
        }
        if($success == true){
            if($rows == 1){	
	            $_SESSION['admin_id']=session_id();
	            $_SESSION['Korisnik_id'] = $Korisnik_id;
	            $_SESSION['Uloga'] = $Uloga;
                $_SESSION['Korisnicko_ime'] = $Korisnicko_ime;
                $_SESSION['Lozinka'] = $Lozinka;
                header("Location: index.php");
            }else{
                echo "<div class='form'> 
                <h3>Korisničko ime i lozinka su netočni.</h3>
                <br/>Klikni ovdje za <a href='prijava.php'>Prijavu</a></div>";
            }
        }
        if($success == false){
            $query ="SELECT * FROM korisnik WHERE Korisnicko_ime = '$Korisnicko_ime' and Lozinka = '$Lozinka' and Uloga='Korisnik'";
    
            $result = mysqli_query($conn,$query);
            $rows = mysqli_num_rows($result);

            while($row = mysqli_fetch_array($result)){
                $success = true;
                $Korisnik_id = $row['ID'];
                $Uloga= $row['Uloga'];
                $Korisnicko_ime = $row['Korisnicko_ime'];
            }
            if($success == true){
                if($rows == 1){
                    $row = mysqli_fetch_assoc($result);
                    $_SESSION['kupac_id']=session_id();
                    $_SESSION['Korisnik_id'] = $Korisnik_id;
	                $_SESSION['Uloga'] = $Uloga;
                    $_SESSION['Korisnicko_ime'] = $Korisnicko_ime;
                    $_SESSION['Lozinka'] = $Lozinka;
                    header("Location: index.php");
                }else{
                    echo "<div class='form'> 
                    <h3>Korisničko ime i lozinka su netočni.</h3>
                    <br/>Klikni ovdje za <a href='prijava.php'>Prijavu</a></div>";
                }
            }
        }  
    }else{
    ?>
    <div class="container">
        <h1>Prijava</h1>
        <?php
            if(isset($_SESSION['Korisnicko_ime'])){
                echo "Pozdrav: {$_SESSION['Korisnicko_ime']}";
                echo "<br/><a href = 'odjava.php'>Odjava</a>";
            }else{
        ?>
        <form action="prijava.php" method="post">
            <table>
                <div class="form-group">
                    <div class="input-group">
                        <label for="name">Korisničko ime: </label>
                        <input id="name" name="Korisnicko_ime" placeholder="Korisničko ime" type="text" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <label for="password">Lozinka: </label>
                        <input id="password" name="Lozinka" placeholder="**********" type="password" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <input name="prijava" type="submit" value="Login ">
                    </div>
                </div> 
            </table>
        </form>
        <p>Nisi se registriarao.<a href="registracija.php">Registriraj se.</a></p>
        <?php
            }
            echo $error;
        ?>
        <?php } ?>
        

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
