<?php
if (!is_writable(session_save_path())) {
    echo 'Session path "'.session_save_path().'" is not writable for PHP!'; 
}
else{
	
ini_set('session.save_path',getcwd().'/nba_sessions');}

session_start();

$path = dirname($_SERVER['PHP_SELF']);

if(TRUE){

$host = 'classmysql.engr.oregonstate.edu';
$user = 'cs340_nguyenau';
$pass ='5840' ; 
$db = 'cs340_nguyenau';
if(isset($_GET['name'])&&$_GET['name']!=""){
	$name = $_GET['name'];
}
else
{
	$name = "James Harden";
	$_GET['name'] = "James Harden";
}


if($conn= mysql_connect($host,$user,$pass)){
	

}
else{
		//header("Location:".$path."/test.php");
		//die();

}

if($select = mysql_select_db($db)){
	//echo "database selected";
}
else{
	//echo "database is not connected";
 /* pChart library inclusions */
}

include("pChart2.1.4/pChart2.1.4/class/pData.class.php");

include("pChart2.1.4/pChart2.1.4/class/pDraw.class.php");

include("pChart2.1.4/pChart2.1.4/class/pRadar.class.php");

include("pChart2.1.4/pChart2.1.4/class/pImage.class.php");

 

/* Prepare some nice data & axis config */ 
$MyData = new pData();   



 
/* Create the pChart object */

$myPicture = new pImage(1500,400,$MyData);

/* Draw a solid background */

$Settings = array("R"=>179, "G"=>217, "B"=>91, "Dash"=>1, "DashR"=>199, "DashG"=>237, "DashB"=>111);

$myPicture->drawFilledRectangle(0,0,1520,420,$Settings);

 
/* Overlay some gradient areas */

$Settings = array("StartR"=>194, "StartG"=>231, "StartB"=>44, "EndR"=>43, "EndG"=>107, "EndB"=>58, "Alpha"=>50);

$myPicture->drawGradientArea(0,0,1520,420,DIRECTION_VERTICAL,$Settings);

$myPicture->drawGradientArea(0,0,1520,20,DIRECTION_VERTICAL,array("StartR"=>0,"StartG"=>0,"StartB"=>0,"EndR"=>50,"EndG"=>50,"EndB"=>50,"Alpha"=>100));

 
/* Draw the border */

$myPicture->drawRectangle(0,0,1519,419,array("R"=>0,"G"=>0,"B"=>0));

 

/* Write the title */

$myPicture->setFontProperties(array("FontName"=>"pChart2.1.4/pChart2.1.4/fonts/Silkscreen.ttf","FontSize"=>6));

$myPicture->drawText(10,13,"NBA STATS ".$_GET['name'],array("R"=>255,"G"=>255,"B"=>255,"FontSize"=>10));

$myPicture->drawText(100,50,"AVERAGE PPG COMPARISON FOR ".$_GET['name'],array("R"=>0,"G"=>0,"B"=>0,"FontSize"=>15));

$myPicture->drawText(850,50,"STATS COMPARISON FOR ".$_GET['name'],array("R"=>0,"G"=>0,"B"=>0,"FontSize"=>15));


/* Define general drawing parameters */

$myPicture->setFontProperties(array("FontName"=>"pChart2.1.4/pChart2.1.4/fonts/Forgotte.ttf","FontSize"=>10,"R"=>80,"G"=>80,"B"=>80));

$myPicture->setShadow(TRUE,array("X"=>2,"Y"=>2,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));

 

/* Create the radar object */

$SplitChart = new pRadar();

 
 function get_average_ppg(){
 	$avg_sql = "SELECT ppg FROM player_info";
 	$result = mysql_query($avg_sql);
 	$result = mysql_fetch_assoc($result);
 	$sum = 0;
 	foreach($result as $key => $value){
 		$sum += $value;
 	}
 	$avg = $sum/count($result);
  	return $avg;
 }

function player_ppg($value){
	$ppg_sql = "SELECT ppg FROM player_info WHERE BINARY name = '$value' ";
	$result = mysql_query($ppg_sql);
	$result = mysql_fetch_assoc($result);
	return $result['ppg'];
}
function draw_bar_chart($name,$avg,$MyData,$myPicture){

$MyData->addPoints(array(player_ppg($name),$avg),"BarPlot");

$MyData->setSerieDescription("BarPlot",$name." AVERAGE VS All Players PPG AVERAGE, PPG - Points Per Game" );
//unset($MyData->Data['Player_Stats']);

unset($MyData->Data['Abscissa']);
$MyData->addPoints(array($name." ppg","Avg ppg"),"Label2");
$MyData->setAbscissa("Label2");	

$myPicture->setGraphArea(100,150,400,350);
$myPicture->drawFilledRectangle(100,150,400,350,array("R"=>255,"G"=>255,"B"=>255,"Surrounding"=>-200,"Alpha"=>10));


$AxisBoundaries = array(0=>array("Min"=>0,"Max"=>80));
$scaleSettings  = array("GridR"=>200,"GridG"=>200,"GridB"=>200,"DrawSubTicks"=>TRUE,"CycleBackground"=>TRUE,"Mode"=>SCALE_MODE_MANUAL, "ManualScale"=>$AxisBoundaries);

$myPicture->drawScale($scaleSettings);

$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));

$myPicture->setFontProperties(array("FontName"=>"pChart2.1.4/pChart2.1.4/fonts/pf_arma_five.ttf","FontSize"=>6));

$myPicture->drawBarChart(array("DisplayValues"=>TRUE,"DisplayColor"=>DISPLAY_AUTO,"Rounded"=>TRUE,"Surrounding"=>60));

$myPicture->drawLegend(120,380,array("Style"=>LEGEND_BOX,"Mode"=>LEGEND_HORIZONTAL,"FontSize"=>10));


}


 function get_data($player){
 	$player = mysql_real_escape_string($player);
 	$get_sql = "SELECT * FROM player_info WHERE BINARY name = '$player'";
 	$result = mysql_query($get_sql) or trigger_error(mysql_error());

 	$result = mysql_fetch_assoc($result);

 	$player_data = array($result['rpg'],$result['bpg'],$result['tpg'],$result['apg'],$result['spg']);

	if($player_data[0] == NULL){
		var_dump("Submit The Full Name in the Right Format");
		exit;
	} 	
 	return $player_data;

 }

 function player_salary($name){

 	$player_salary = "SELECT name,salary,ppg FROM player_info WHERE name = '$name'";
 	$result = mysql_query($player_salary);
 	$result = mysql_fetch_assoc($result);

 	$salary = $result['salary'];
 	$closest_salary = "SELECT name,salary,ppg from player_info ORDER BY ABS(salary-'$salary') LIMIT 5";


 	

 	$result2 = mysql_query($closest_salary);

 	$new_result = array();

	while($temp = mysql_fetch_assoc($result2)){
	//		var_dump($temp);
			
				# code...
			array_push($new_result,$temp);

			
	}

	return $new_result;

	
}

$salaries = player_salary($name);

 $avg = get_average_ppg();
 


 $player_data = get_data($name);


$MyData->addPoints($player_data,"Player_Stats");
//$MyData->setSerieDrawable("BarPlot", FALSE);
$MyData->setSerieDescription("Player_Stats","Player Statistics- \n\n\n APG - Assists per Game \n\n\n SPG - Steals per Game \n\n\n BPG - Blocks per Game \n\n\n RPG - Rebounds per Game \n\n\n TPG - Throws per Game");

function draw_horizontal_chart($salaries,$values,$MyData,$myPicture){

	/* Create the pChart object */
//$myPicture = new pImage(200,500,$MyData);


$myPicture->setGraphArea(1250,150,1500,350);

//var_dump($MyData->getData());
unset($MyData->Data['Abscissa']);
$MyData->setSerieDrawable("Label2",FALSE);



$salaries_group = array();
$absc = array();
//var_dump($salaries);

foreach($salaries as $key => $value){
	
	array_push($salaries_group, $value['salary']);
	array_push($absc, $value['name']." PPG = (".$value['ppg'].")");

}

$MyData->addPoints($salaries_group,"Player_salary");
$MyData->addPoints($absc,"sals");


$MyData->setAbscissa("sals");
$MyData->setSerieDescription("Player_salary","Salary of the Players in Millions, Based on Similar PPG");


$myPicture->setFontProperties(array("FontName"=>"pChart2.1.4/pChart2.1.4/fonts/pf_arma_five.ttf","FontSize"=>6));

$myPicture->drawScale(array("CycleBackground"=>TRUE,"DrawSubTicks"=>TRUE,"GridR"=>0,"GridG"=>0,"GridB"=>0,"GridAlpha"=>10, "Pos"=>SCALE_POS_TOPBOTTOM)); 


$myPicture->drawBarChart(array("DisplayPos"=>LABEL_POS_INSIDE,"DisplayValues"=>TRUE,"Rounded"=>TRUE,"Surrounding"=>30));

$myPicture->drawLegend(1250,370,array("Style"=>LEGEND_BOX,"Mode"=>LEGEND_HORIZONTAL));

}

function draw_radar_chart($SplitChart,$myPicture,$MyData){

//$MyData->setSerieDrawable("Labels", TRUE);
//$MyData->setAbscissa("Labels");
//$MyData->setSerieDrawable("BarPlot",FALSE);
$MyData->addPoints(array("BPG","RPG","TPG","APG","SPG"),"Labels");
$MyData->setAbscissa("Labels");


$myPicture->setGraphArea(740,80,1100,400);


$Options = array("Layout"=>RADAR_LAYOUT_CIRCLE, "LabelPos"=>RADAR_LABELS_HORIZONTAL, "BackgroundGradient"=>array("StartR"=>255,"StartG"=>255,"StartB"=>255,"StartAlpha"=>50,"EndR"=>32,"EndG"=>109,"EndB"=>174,"EndAlpha"=>30));
 
$SplitChart->drawRadar($myPicture,$MyData,$Options);
$myPicture->drawLegend(1100,150,array("Style"=>LEGEND_BOX,"Mode"=>LEGEND_HORIZONTAL,"FontSize"=> 20));

}

draw_radar_chart($SplitChart,$myPicture,$MyData);

$MyData->setSerieDrawable("Labels", FALSE);
$MyData->setSerieDrawable("Player_Stats", FALSE);
draw_bar_chart($name,$avg,$MyData,$myPicture);

$MyData->setSerieDrawable("player_data", FALSE);
$MyData->setSerieDrawable("BarPlot",FALSE);
//draw_horizontal_chart($salaries,$avg,$MyData,$myPicture);


/* Write down the legend */
//$myPicture->setFontProperties(array("FontName"=>"pChart2.1.4/pChart2.1.4/fonts/pf_arma_five.ttf","FontSize"=>6));


 
$text = preg_replace('/\s+/', '', $name);
$_SESSION['name'] = $text;



/* Render the picture */
$myPicture->Render($text.'.png');
header("Location:".$path."/proj.php");
die();
}

else{
	header("Location:".getcwd()."/proj.php");
}
