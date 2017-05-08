<?php 
$path = dirname($_SERVER['PHP_SELF']);


	mkdir(getcwd().'/nba_sessions', 0755, true);



if (!is_writable(session_save_path())) {
    echo 'Session path "'.session_save_path().'" is not writable for PHP!'; 
}
else{
	
ini_set('session.save_path',getcwd().'/nba_sessions');
}
session_start();
//echo $_SESSION['REQUEST_URI'];
if(isset($_SESSION['name'])){
	//echo $_SESSION['name'];
	$name = $_SESSION['name'];

	$status = chmod(getcwd()."/".$_SESSION['name'].'.png', 0755);
}
else{
	echo "no session set";
}

?>

<html>

<head>
   <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

<style>

body {background-color: powderblue;}
.list-group-item {
    padding: 3px 10px;
}
</style>

</head>
<body>

<div class="container-fluid">
  <div class="row">
  <div class="col-md-4">
  <h1 style="text-align: center"> NBA PLAYER STATS</h1>
  </div>
  <div class="col-sm-4" style="padding-top:120px;">

 <form action="vis_proj.php" method="GET">
  <div class="form-group" >
  
    <label for="name">Player Name:</label>
    <input type="text" class="form-control" id="name" name="name"  placeholder="Enter Name" >
  <button  style="margin-top: 10px;" type="submit" class="btn btn-default">Submit</button>
  </div>
  </div>
  </form>
   <div class="col-md-4">
  <h2>Player Search Examples</h2>
  <ul class="list-group">
  <li class="list-group-item">James Harden</li>
  <li class="list-group-item">Danilo Gallinari</li>
  <li class="list-group-item">Jordan Clarkson</li>
  <li class="list-group-item">Jeremy Lin</li>
  <li class="list-group-item">Jordan Crawford</li>
</ul>

 </div> 
  </div>

  <div style="padding-top:10px;" class="row">
   
  <div class="col-sm-12">
<img src= <?php if(isset($_SESSION['name'])) {echo $path."/".$_SESSION['name'].'.png';} else{echo "nba_default.png";}?> class="pull-right img-responsive"  />
</div>
</div>

</body>


<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</html>