<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
    .modal-open .modal,.btn:focus{
      outline:none!important
    }
    </style>
    <title>Distance Learning</title>
</head>
<body>  
 <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="/project/index.php" style="font-variant: small-caps;"><strong>Distance Learning</strong></a>
    </div>
    <ul id="menu" class="nav navbar-nav">
      <li id="home"><a href="/project/index.php">Home</a></li>

     <!--  <li><a href="#">Page 2</a></li>
      <li><a href="#">Page 3</a></li> -->
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li id="login"><a href="/project/login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    </ul>
  </div>
</nav>
<script type="text/javascript">
  if ( "<?php echo $_SESSION["logged_in"]; ?>" == "1" ){
    document.getElementById("login").innerHTML = '<a href="/project/logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a>';
    document.getElementById("menu").innerHTML += '<li id="courses"><a href="/project/courses.php">Courses</a></li>';
  }
</script>