<?php
//maak connectie met de database
	session_start();
	require_once('config.php');
	
	if(isset($_POST['submit']))
	{
		$error_msg = [];
		//plaats de informatie in database tabel
		if(isset($_POST['Naam'],$_POST['Vraag'])  && !empty($_POST['Naam']) && !empty($_POST['Vraag']))
		{
			$Naam 		= filter_var(trim($_POST['Naam']),FILTER_SANITIZE_STRING);
			$Vraag 	= filter_var(trim($_POST['Vraag']),FILTER_SANITIZE_STRING);
			
			$sql = "insert into blog (Naam, Vraag) values ('$Naam','$Vraag')";
			$rs = mysqli_query($con,$sql);
			
			if(mysqli_affected_rows($con) == 1)
			{
				$lastInsertedID = mysqli_insert_id($con);
				$_SESSION['success_msg'] = 'Je vraag is gesteld';
				header('location:edit.php?id='.$lastInsertedID);
				exit();
			}
			else
			{
				$error_msg[] = 'kan vraag niet opslaan' ;
			}
			
		}
		else
		{
			if(!isset($_POST['Naam']) || empty($_POST['Naam']))
			{
				$error_msg[] = 'Naam is required' ;
			}
			
			if(!isset($_POST['Vraag']) || empty($_POST['Vraag']))
			{
				$error_msg[] = 'Vraag is required' ;
			}
			
		}
	}
	
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
</div>
	<div class="container">
		<h2>Stel je vraag</h2>
		
		<?php 
			if(isset($_SESSION['success_msg']))
			{
				echo '<div class="success-msg">'.$_SESSION['success_msg'].'</div>';
				unset($_SESSION['success_msg']);
			}
			
			if(isset($error_msg) && !empty($error_msg))
			{
				foreach($error_msg as $error)
				{
					echo '<div class="error-msg">'.$error.'</div>';
				}
			}
			
		?>
		<div class="align-center">
			<form action="" method="POST">
				<div class="form-group">
					<label for="Naam">Naam</label>
					<input type="text" name="Naam" placeholder="Enter Naam" id="Naam">
				</div>
				<div class="form-group">
					<label for="Vraag">Vraag</label>
					<textarea type ="text" name="Vraag" id="Vraag"></textarea>
				</div>
				
					</select>
				</div>
				<div class="form-group">
					<button type="submit" name="submit">Submit</button>
					<a href="index.php" class="back-link" style="float:right"><< Back</a>
				</div>
			</form>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	
</body>
</html>
