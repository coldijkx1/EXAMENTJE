<?php
//connect met de database
	session_start();
	require_once('config.php');
	
	//hier word de row geslecteed die aan geklikt word
	$sql = 'select * from Reis order by id desc';
	$rs = mysqli_query($con,$sql);
?>

 
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Student</title>
	<!--Gebruik styling-->
	<style>
  		<?php include "../style.css" ?>
	</style>
</head>
<body>
		<!--Dit is de navbar boven aan het scherm-->
<div class="topnav">
  <a class="active" href="../index.html">Home</a>
  <a href="loginStudent.php">Opnieuw Inloggen</a>
  <a href="faq/index.php">FAQ</a>
</div>

	<div class="container">
		<h2>Informatie over de reizen</h2>
		
		<?php 
			if(isset($_SESSION['success_msg']))
			{
				echo '<div class="success-msg">'.$_SESSION['success_msg'].'</div>';
				unset($_SESSION['success_msg']);
			}
			
			if(isset($_SESSION['error_msg']))
			{
				echo '<div class="error-msg">'.$_SESSION['error_msg'].'</div>';
				unset($_SESSION['error_msg']);
			}
			
		?>
		
		<table class="table">
			<tr>
				<th>#</th>
				<th>Boekingsnummer</th>
				<th>Titel</th>
				<th>Bestemming</th>
				<th>Omschrijving</th>
                <th>Begindatum</th>
                <th>Einddatum</th>
                <th>Maximaalaantalinschrijvingen</th>
			</tr>
			<?php 
				while($row = mysqli_fetch_assoc($rs))
				{
			?>
					<tr>
						<td> <?php echo $row['id']?> </td>
						<td> <?php echo $row['Boekingsnummer']?> </td>
						<td> <?php echo $row['Titel']?> </td>
                        <td> <?php echo $row['Bestemming']?> </td>
                        <td> <?php echo $row['Omschrijving']?> </td>
                        <td> <?php echo $row['Begindatum']?> </td>
                        <td> <?php echo $row['Einddatum']?> </td>
                        <td> <?php echo $row['Maxinschrijvingen']?> </td>
						<td>  
							<a href="submit/index.php?id=<?php echo $row['id']?>" >Inschrijven</a> |
							<a href="select.php?id=<?php echo $row['id']?>" >Details</a> | 

						</td>
					</tr>
			<?php 
				}
			?>
		</table>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script>
		$(document).ready(function(){
			$(".delete-record").click(function(e){
				e.preventDefault();
				
				var confirmBox = confirm('Are you Sure?');
				
				if(confirmBox == true)
				{	
					var getHref = $(this).attr('href');
					window.location.href=getHref;
				}
				
				
			});
		});
		
		
	</script>	
</body>
</html>