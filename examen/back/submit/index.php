<!DOCTYPE html>
<html>
<head>
    <title>Submit</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
    <style>
        <?php include "../../style.css" ?>
    </style>
</head>
<body>
<!--Dit is de navbar boven aan het scherm-->
<div class="topnav">
  <a class="active" href="../../index.html">Home</a>
  <a href="../loginAdmin.php">Login als Admin</a>
</div>
<!--Container met het inlogform-->
<div class="container">
    <div class="h20"></div>
    <div class="well main">
        <div class="row">
            <div class="col-lg-12">
                <span class="title"><center>Schrijf je hier in voor een reis</center></span>
            </div>
        </div>
        <div class="h20"></div>
        <form id="form">
        <div class="row">
            <div class="col-lg-2">
                <span class="desc">Studentnummer:</span>
            </div>
            <div class="col-lg-10">
                <input type="text" name="Studentnummer" class="form-control">
            </div>
        </div>
        <div class="h10"></div>
        <div class="row">
            <div class="col-lg-2">
                <span class="desc">Boekingsnummer:</span>
            </div>
            <div class="col-lg-10">
                <input type="text" name="Boekingsnummer" class="form-control">
            </div>
        </div>
        <div class="h10"></div>
        <div class="row">
            <div class="col-lg-2">
                <span class="desc">Nummerid:</span>
            </div>
            <div class="col-lg-10">
                <input type="text" name="Nummerid" class="form-control">
            </div>
        </div>
        <div class="h10"></div>
        <div class="row">
            <div class="col-lg-2">
                <span class="desc">Opmerkingen:</span>
            </div>
            <div class="col-lg-10">
                <input type="text" name="opmerkingen" class="form-control">
            </div>
        </div>
        </form>
        <div class="h10"></div>
        <div class="row">
            <div class="col-lg-12">
                <button type="button" class="btn btn-primary pull-right" id="submit">Submit</button>
               
            </div>
        </div>
    </div>
    <div class="h20"></div>
    <div class="row">
        <div id="table">
        </div>
    </div>
</div>

<a href="../studentindex.php" class="back-link" style="float:right"><< Back</a>
<script src="custom.js"></script>
</body>
</html>