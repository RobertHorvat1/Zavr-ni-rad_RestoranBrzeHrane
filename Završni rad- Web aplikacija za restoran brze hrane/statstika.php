<?php
function statistikaUkupnoKorisnikaUnos($conn){
    $sql3 = "SELECT Ukupno_korisnika FROM statistika";
    $rezultat = $conn->query($sql3);
    if(mysqli_query($conn, $sql3)) {
        while($row = $rezultat->fetch_assoc()){   
            $Ukupno_korisnika = $row['Ukupno_korisnika'];
        }
    }
    $Ukupno_korisnika = $Ukupno_korisnika + 1;
    $sql4 = "UPDATE statistika SET Ukupno_korisnika='$Ukupno_korisnika'";
    $rez = $conn->query($sql4); 
}

function statistikaUkupnoNarudzbiUnos($conn){
    $sql5 = "SELECT Ukupno_narudzba FROM statistika";
    $rezultat = $conn->query($sql5);
    if(mysqli_query($conn, $sql5)) {
        while($row = $rezultat->fetch_assoc()){   
            $Ukupno_narudzba = $row['Ukupno_narudzba'];
        }
    }
    $Ukupno_narudzba = $Ukupno_narudzba + 1;
    $sql6 = "UPDATE statistika SET Ukupno_narudzba='$Ukupno_narudzba'";
    $rez = $conn->query($sql6); 
}

function statistikaUkupnoZaradaUnos($conn){
    $db_handle = new DBController();
    $ukupni_zbroj=0;
    $zbroj = $db_handle->runQuery("SELECT `Ukupna_cijena` FROM `narudzba`");
    if($zbroj==TRUE) {
        $zbrojArray = array('Ukupna_cijena'=>$zbroj[0]["Ukupna_cijena"]);
    }
    if (!empty($zbroj)) { 
        foreach($zbroj as $key=>$value){
            $ukupni_zbroj += $zbroj[$key]["Ukupna_cijena"];
        }
    }
    $sql7 = "UPDATE statistika SET Zbroj_zarade='$ukupni_zbroj'";
    $rez = $conn->query($sql7); 

}

function statistikaUkupnoUkupnoPosjetaWebStraniciiUnos($conn){
    if(isset($_SESSION['views'])){ 
        $_SESSION['views'] = $_SESSION['views']+1;
        $Ukupno_pogleda_web=$_SESSION['views'];
        $sql9 = "UPDATE statistika SET Ukupno_pogleda_web='$Ukupno_pogleda_web'";
        $rez = $conn->query($sql9);
    }else{
    $_SESSION['views']=1;
    }   
}



?>