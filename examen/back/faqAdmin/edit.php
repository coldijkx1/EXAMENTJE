<?php
//maak een connectie met de database
	session_start();
	require_once('config.php');
	
	//krijg id
	if(!isset($_GET['id']))
	{
		header('location:index.php');
		exit();
	}
	
	//verzend informatie
	if(isset($_POST['submit']))
	{
		$error_msg = [];
		
		if(isset($_POST['author']) && !empty($_POST['author']))
		{
			$id = intval(trim($_GET['id']));
			$author = filter_var(trim($_POST['author']),FILTER_SANITIZE_STRING);
			
			//update tabel
			$sql = "update blog set Antwoord='".$author."' where id = ".$id;
			
			$rs = mysqli_query($con,$sql);
			
			if(mysqli_affected_rows($con) == 1)
			{
				$_SESSION['success_msg'] = 'Editen is gelukt';
				header('location:edit.php?id='.$id);
				exit();
			}
			else
			{
				$error_msg[] = 'Niet gelukt' ;
			}
			
		}
		else
		{

			if(!isset($_POST['author']) || empty($_POST['author']))
			{
				$error_msg[] = 'Antwoord is required' ;
			}
			
		}
	}
	
	//zoek in database tabel
	$sql = 'select * from blog where id = '.$_GET['id'];
	$rs = mysqli_query($con,$sql);
	$row = mysqli_fetch_assoc($rs);
	
?>
 
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Faq</title>
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
		<h2>Edit Vraag</h2>
		
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
					<label for="author">Antwoord</label>
					<textarea name="author" id="author"><?php echo $row['author'];?></textarea>
				</div>
				
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