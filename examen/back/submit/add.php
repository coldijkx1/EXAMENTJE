<?php 
//maak connectie met de database
    include('conn.php');
    //vang informatie op en stop het in de database tabel
    if(isset($_POST['Studentnummer'])){
        $firstname=$_POST['Studentnummer'];
        $lastname=$_POST['Boekingsnummer'];
        $username=$_POST['Nummerid'];
        $password=$_POST['Opmerkingen'];
 
        mysqli_query($conn,"insert into inschrijven (Studentnummer, Boekingsnummer, Nummerid, Opmerkingen) values ('$Studentnummer', '$Boekingsnummer', '$Nummerid', '$Opmerkingen')");
    }
?>