<?php
//maak connectie met database
	session_start();
	require_once('config.php');
	
	if(isset($_POST['submit']))
	{
		$error_msg = [];
		//plaats (POST) informatie in database tabel
		if(isset($_POST['Naam'],$_POST['Vraag'],$_POST['author'])  && !empty($_POST['Naam']) && !empty($_POST['Vraag'])&& !empty($_POST['author']))
		{
			$Naam 		= filter_var(trim($_POST['Naam']),FILTER_SANITIZE_STRING);
			$Vraag 	= filter_var(trim($_POST['Vraag']),FILTER_SANITIZE_STRING);
			$author 	= filter_var(trim($_POST['author']),FILTER_SANITIZE_STRING);
			
			$sql = "insert into blog (Naam, Vraag, author) values ('$Naam','$Vraag','$author')";
			$rs = mysqli_query($con,$sql);
			
			if(mysqli_affected_rows($con) == 1)
			{
				$lastInsertedID = mysqli_insert_id($con);
				$_SESSION['success_msg'] = 'Het is gelukt';
				header('location:edit.php?id='.$lastInsertedID);
				exit();
			}
			else
			{
				$error_msg[] = 'kan niet opslaan' ;
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

			if(!isset($_POST['author']) || empty($_POST['author']))
			{
				$error_msg[] = 'author is required' ;
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
  <a href="../faq/index.php">FAQ</a>
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
		<!--form die je op de webpage ziet-->
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
				<div class="form-group">
					<label for="author">Antwoord</label>
					<textarea type ="text" name="author" id="author"></textarea>
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
