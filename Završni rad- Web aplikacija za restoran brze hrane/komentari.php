<?php

function unesiKomentar($conn){
    if(isset($_POST['komentarSubmit'])){
        $Korisnicko_ime = $_POST['Korisnicko_ime'];
        $Komentar = $_POST['Komentar'];
        $id_stranice = $_POST['id_stranice'];

        $sql = "INSERT INTO komentari (Korisnicko_ime, Komentar, ID_stranice) VALUES ('$Korisnicko_ime', '$Komentar', '$id_stranice')";
        $resultat = $conn->query($sql); 
    }
}

function dohvatiKomentar($conn, $id_stranice){
    //$id_stranice = $_POST['id_stranice'];
    $sql = "SELECT * FROM komentari WHERE ID_stranice='$id_stranice'";
    $rezultat = $conn->query($sql);
    $error="";
        if(mysqli_query($conn, $sql)) {
            while($row = $rezultat->fetch_assoc()){   
                echo "<div class='komentari-box'><p>";
                echo $row['Korisnicko_ime']."<br><br>";
                echo $row['Datum']."<br><br>";
                echo nl2br($row['Komentar']);
                echo "</div>";
            }
        } else {
            $error = "Error: " . $sql . "<br>" . mysqli_error($conn);
            echo $error;
        }
            
       
    
}


?>