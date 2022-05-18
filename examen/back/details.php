<?php 
//maakt de connectie met de database
	include('conn.php');

//Selecteerd de gegevens en displayt ze op de pagina
$sql = "SELECT id, Boekingsnummer, Titel, Bestemming, Omschrijving, Begindatum, Einddatum, Maxinschrijvingen FROM Reis";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Data laten zien
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " Boekings nummer " . $row["Boekingsnummer"]. " Titel " . $row["Titel"]. " Bestemming " . $row["Bestemming"]. " Omschrijving" . $row["Omschrijving"]. " Begindatum" . $row["Begindatum"]. " Einddatum" . $row["Einddatum"]. " " . $row["Maxinschrijvingen"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>