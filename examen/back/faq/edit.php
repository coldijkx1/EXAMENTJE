<?php
//connectie met de database
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
		
		if(isset($_POST['Naam'],$_POST['Vraag'])  && !empty($_POST['Naam']) && !empty($_POST['Vraag']))
		{
			$id = intval(trim($_GET['id']));
			$Naam 	= filter_var(trim($_POST['Naam']),FILTER_SANITIZE_STRING);
			$Vraag = filter_var(trim($_POST['Vraag']),FILTER_SANITIZE_STRING);
			
			//update de database
			$sql = "update blog set Naam = '".$Naam."', Vraag='".$Vraag."' where id = ".$id;
			
			$rs = mysqli_query($con,$sql);
			
			if(mysqli_affected_rows($con) == 1)
			{
				$_SESSION['success_msg'] = 'Vraag is gelukt';
				header('location:edit.php?id='.$id);
				exit();
			}
			else
			{
				$error_msg[] = 'Nier gelukt' ;
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
	
	//selecteer id
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
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
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
					<label for="Naam">Naam</label>
					<input type="text" name="Naam" placeholder="Enter Naam" id="Naam" value="<?php echo $row['title'];?>">
				</div>
				<div class="form-group">
					<label for="Vraag">Vraag</label>
					<textarea name="Vraag" id="Vraag"><?php echo $row['Vraag'];?></textarea>
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