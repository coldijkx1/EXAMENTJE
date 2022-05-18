<?php
//maak connectie met de database
    include('conn.php');
    if(isset($_POST['fetch'])){
        ?>
        <table class="table table-bordered table-striped">
            <thead>
                <th>Studentnummer</th>
                <th>Boekingsnummer</th>
                <th>Nummerid</th>
                <th>Opmerkingen</th>
            </thead>
            <tbody>
                <?php
                    $query=mysqli_query($conn,"select * from inschrijven order by userid desc");
                    while($row=mysqli_fetch_array($query)){
                    ?>
                    <tr>
                        <td><?php echo $row['Studentnummer']; ?></td>
                        <td><?php echo $row['Boekingsnummer']; ?></td>
                        <td><?php echo $row['Nummerid']; ?></td>
                        <td><?php echo $row['Opmerkingen']; ?></td>
                    </tr>
                    <?php
                    }
                ?>
            </tbody>
        </table>
        <?php	
    }
?>