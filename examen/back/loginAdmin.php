<!DOCTYPE html>
<html>
<head>
<title>LoginAdmin Pagina</title>
<style>
  <?php include "../style.css" ?>
</style>
</head>
<body>
  <!--Dit is de navbar boven aan het scherm-->
<div class="topnav">
  <a class="active" href="../index.html">Home</a>
  <a href="loginStudent.php">Login als Student</a>
</div>

<?php
// variabelen difinieren
$Message = $ErrorUname = $ErrorPass = "";
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $username = check_input($_POST["username"]);
 
    if (!preg_match("/^[a-zA-Z0-9_]*$/",$username)) {
      $ErrorUname = "Space and special characters not allowed but you can use underscore(_)."; 
    }
    else{
        $fusername=$username;
    }
 
    $fpassword = check_input($_POST["password"]);
 
  if ($ErrorUname!=""){
    $Message = "Login failed! Errors found";
  }
  else{
  include('conn.php');
 
  $query=mysqli_query($conn,"select * from `adminuser` where username='$fusername' && password='$fpassword'");
  $num_rows=mysqli_num_rows($query);
  $row=mysqli_fetch_array($query);
 
  if ($num_rows>0){
      $Message = "Login Successful!";
  }
  else{
    $Message = "Login Mislukt! Verkeerde gegevens ingevuld";
  }
 
  }
}
 
function check_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
 
<h2>Login Form</h2>
<p><span class="message">* required field.</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Username: <input type="text" name="username" required>
  <span class="message">* <?php echo $ErrorUname;?></span>
  <br><br>
  Password: <input type="password" name="password" required>
  <span class="message">* <?php echo $ErrorPass;?></span>
  <br><br>
  <input type="submit" name="submit">
  <br><br>
</form>
 
<span class="message">
<?php
    if ($Message=="Login Successful!"){
        echo $Message;
        echo 'Welcome, '.$row['fullname'];
        echo "<p><a href='index.php'>Ga verder</a></p>";
    }
    else{
        echo $Message;
    }
 
?>
</span>
 
</body>
</html>