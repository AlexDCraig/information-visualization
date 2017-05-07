<?php 
session_start();
if(isset($_SESSION['name'])){
	//echo $_SESSION['name'];
	$name = $_SESSION['name'];
	
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
  <div class="col-md-8">
  <h1 style="text-align: center"> NBA PLAYER STATS</h1>
  </div>
  <div>
 
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
  <div style="padding-top:100px;" class="row">
 <form action="vis_proj.php" method="GET">
  <div class="col-sm-10">
  <div class="form-group" >
  
    <label for="name">Player Name:</label>
    <input type="text" class="form-control" id="name" name="name"  placeholder="Enter Name" >
  <button  style="margin-top: 10px;" type="submit" class="btn btn-default">Submit</button>
  </div>
  </div>
  </form>
  
  
  <div class="container">
  <div class="col-sm-5">
<img src= <?php if(isset($_SESSION['name'])) {echo $_SESSION['name'].'.png';} else{echo "";}?> class="pull-right img-responsive" />
</div>
</div>
</div>

</body>


<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</html>