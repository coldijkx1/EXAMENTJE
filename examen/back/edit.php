<?php
//connectie met de database maken
	session_start();
	require_once('config.php');
	
	if(!isset($_GET['id']))
	{
		header('location:index.php');
		exit();
	}
	
	
	if(isset($_POST['submit']))
	{
		$error_msg = [];
		
		//form om reis aan te passen
		if(isset($_POST['Boekingsnummer'],$_POST['Titel'],$_POST['Bestemming'],$_POST['Omschrijving'],$_POST['Begindatum'],$_POST['Einddatum'],$_POST['Maxinschrijvingen']) && !empty($_POST['Boekingsnummer'])&& !empty($_POST['Titel'])&& !empty($_POST['Bestemming'])&& !empty($_POST['Omschrijving'])&& !empty($_POST['Begindatum'])&& !empty($_POST['Einddatum'])&& !empty($_POST['Maxinschrijvingen']))
		{
			$Boekingsnummer 		= filter_var(trim($_POST['Boekingsnummer ']),FILTER_SANITIZE_STRING);
			$Titel 	= filter_var(trim($_POST['Titel']),FILTER_SANITIZE_STRING);
			$Bestemming	= filter_var(trim($_POST['Bestemming']),FILTER_SANITIZE_STRING);
            $Omschrijving	= filter_var(trim($_POST['Omschrijving']),FILTER_SANITIZE_STRING);
			$Begindatum	= date('Y-m-d H:i:s');
            $Einddatum 	= date('Y-m-d H:i:s');
            $Maxinschrijvingen	= filter_var(trim($_POST['Maxinschrijvingen']),FILTER_SANITIZE_STRING);
			
			// hier worden de gevens geupdate
			$sql = "update Reis set Boekingsnummer = '".$Boekingsnummer."', Titel='".$Titel."', Bestemming='".$Bestemming."', Omschrijving='".$Omschrijving."', Begindatum='".$Begindatum."', Einddatum='".$Einddatum."', Maxinschrijvingen='".$Maxinschrijvingen."' where id = ".$id;
			
			$rs = mysqli_query($con,$sql);
			
			if(mysqli_affected_rows($con) == 1)
			{
				$_SESSION['success_msg'] = 'de reis is succesvol geupdate';
				header('location:edit.php?id='.$id);
				exit();
			}
			else
			{
				$error_msg[] = 'kan reis niet opslaan' ;
			}
			
		}
		else
		{
			if(!isset($_POST['Boekingsnummer']) || empty($_POST['Boekingsnummer']))
			{
				$error_msg[] = 'Boekingsnummer is required' ;
			}
			
			if(!isset($_POST['Titel']) || empty($_POST['Titel']))
			{
				$error_msg[] = 'Titel is required' ;
			}
			
			if(!isset($_POST['Bestemming']) || empty($_POST['Bestemming']))
			{
				$error_msg[] = 'Bestemming is required' ;
			}
            if(!isset($_POST['Omschrijving']) || empty($_POST['Omschrijving']))
			{
				$error_msg[] = 'Omschrijving is required' ;
			}
            if(!isset($_POST['Begindatum']) || empty($_POST['Begindatum']))
			{
				$error_msg[] = 'Begindatum is required' ;
			}
            if(!isset($_POST['Einddatum']) || empty($_POST['Einddatum']))
			{
				$error_msg[] = 'Einddatum is required' ;
			}
            if(!isset($_POST['Maxinschrijving']) || empty($_POST['inschrijving']))
			{
				$error_msg[] = 'inschrijvingen zijn required' ;
			}
		}
	}
	
	//selecteer id uit database tabel
	$sql = 'select * from Reis where id = '.$_GET['id'];
	$rs = mysqli_query($con,$sql);
	$row = mysqli_fetch_assoc($rs);
	
?>
 
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Aanpassen</title>
	<style>
  		<?php include "../style.css" ?>
	</style>
</head>
<body>
	<!--Dit is de navbar boven aan het scherm-->
<div class="topnav">
  <a class="active" href="../index.html">Home</a>
  <a href="loginStudent.php">Opnieuw Inloggen</a>
</div>
	<div class="container">
		<h2>Pas een reis aan</h2>
		
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
					<label for="title">Boekingsnummer</label>
					<input type="number" name="Boekingsnummer" placeholder="Enter Boekingsnummer" id="Boekingsnummer" value="<?php echo $row['Boekingsnummer'];?>">
				</div>
				<div class="form-group">
					<label for="content">Titel</label>
					<textarea name="Titel" id="Titel"><?php echo $row['Titel'];?></textarea>
				</div>
                <div class="form-group">
					<label for="content">Bestemming</label>
					<textarea name="Bestemming" id="Bestemming"><?php echo $row['Bestemming'];?></textarea>
				</div>
                <div class="form-group">
					<label for="content">Omschrijving</label>
					<textarea name="Omschrijving" id="Omschrijving"><?php echo $row['Omschrijving'];?></textarea>
				</div>
                <div class="form-group">
					<label for="content">Begindatum</label>
					<input type="date" name="Begindatum" id="Begindatum"><?php echo $row['Begindatum'];?></input>
				</div>
                <div class="form-group">
					<label for="content">Einddatum</label>
					<input type="date" name="Einddatum" id="Einddatum"><?php echo $row['Einddatum'];?></input>
				</div>
                <div class="form-group">
					<label for="content">Maxinschrijvingen</label>
					<input type="number" name="Maxinschrijvingen" id="Maxinschrijvingen"><?php echo $row['Maxinschrijvingen'];?></unput>
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