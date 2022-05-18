<?php
//connect met de database
	session_start();
	require_once('config.php');
	
	//selecteer id uit tabel
	$sql = 'select * from blog order by id desc';
	$rs = mysqli_query($con,$sql);
?>
 
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>faq</title>
	<style>
  		<?php include "../../style.css" ?>
	</style>
</head>
<body>
		<!--Dit is de navbar boven aan het scherm-->
		<div class="topnav">
  <a class="active" href="../../index.html">Home</a>
  <a href="../loginStudent.php">Opnieuw Inloggen</a>
  <a href="../faq/index.php">FAQ</a>
</div>
	<div class="container">
		<h2>Vragen</h2>
		<a href="create.php" class="add-new">Beantwoord een vraag</a>
		
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
		<!---Tabel dit je op de webpage ziet-->
		<table class="table">
			<tr>
				<th>Naam</th>
				<th>Vraag</th>
				<th>Antwoord</th>
			</tr>
			<?php 
				while($row = mysqli_fetch_assoc($rs))
				{
			?>
					<tr>
						<td> <?php echo $row['Naam']?> </td>
						<td> <?php echo $row['Vraag']?> </td>
						<td> <?php echo $row['author']?> </td>
						<td>  
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
	 <a href="../index.php" class="back-link" style="float:right"><< Back</a>
</body>
</html>