<?php
session_start();

if(isset($_GET['name'])&&$_GET['name']!=""){


$user = 'root';
$pass ='' ; 
$db = 'nba';
$name = $_GET['name'];
mysql_connect('localhost',$user,$pass);

mysql_select_db($db);
echo " database is connected". "<br/>";
 /* pChart library inclusions */

include("pChart2.1.4/pChart2.1.4/class/pData.class.php");

include("pChart2.1.4/pChart2.1.4/class/pDraw.class.php");

include("pChart2.1.4/pChart2.1.4/class/pRadar.class.php");

include("pChart2.1.4/pChart2.1.4/class/pImage.class.php");

 

/* Prepare some nice data & axis config */ 
$MyData = new pData();   

//$MyData->addPoints(array(40,20,15,10,8,4),"ScoreA"); 

//$MyData->addPoints(array(8,10,12,20,30,15),"ScoreB"); 

//$MyData->setSerieDescription("ScoreA","Application A");

//$MyData->setSerieDescription("ScoreB","Application B");

 

/* Create the X serie */ 


//$MyData->addPoints(array("BPG","RPG","TPG","APG","SPG"),"Labels");


//$MyData->setAbscissa("Labels");

 
/* Create the pChart object */

$myPicture = new pImage(1000,230,$MyData);

/* Draw a solid background */

$Settings = array("R"=>179, "G"=>217, "B"=>91, "Dash"=>1, "DashR"=>199, "DashG"=>237, "DashB"=>111);

$myPicture->drawFilledRectangle(0,0,1000,230,$Settings);

 
/* Overlay some gradient areas */

$Settings = array("StartR"=>194, "StartG"=>231, "StartB"=>44, "EndR"=>43, "EndG"=>107, "EndB"=>58, "Alpha"=>50);

$myPicture->drawGradientArea(0,0,1000,230,DIRECTION_VERTICAL,$Settings);

$myPicture->drawGradientArea(0,0,1000,20,DIRECTION_VERTICAL,array("StartR"=>0,"StartG"=>0,"StartB"=>0,"EndR"=>50,"EndG"=>50,"EndB"=>50,"Alpha"=>100));

 
/* Draw the border */

$myPicture->drawRectangle(0,0,999,229,array("R"=>0,"G"=>0,"B"=>0));

 

/* Write the title */

$myPicture->setFontProperties(array("FontName"=>"pChart2.1.4/pChart2.1.4/fonts/Silkscreen.ttf","FontSize"=>6));

$myPicture->drawText(10,13,"NBA STATS ".$_GET['name'],array("R"=>255,"G"=>255,"B"=>255));

 

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

//$MyData->setSerieDrawable("Labels", FALSE);

function draw_bar_chart($value,$MyData,$myPicture){

$MyData->addPoints(array(10,20),"BarPlot");

unset($MyData->Data['Abscissa']);
$MyData->addPoints(array("Player ppg","Avg ppg"),"Label2");
$MyData->setAbscissa("Label2");	

$myPicture->setGraphArea(450,60,600,190);
$myPicture->drawFilledRectangle(450,60,600,190,array("R"=>255,"G"=>255,"B"=>255,"Surrounding"=>-200,"Alpha"=>10));

$myPicture->drawScale(array("DrawSubTicks"=>TRUE));

$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));

$myPicture->setFontProperties(array("FontName"=>"pChart2.1.4/pChart2.1.4/fonts/pf_arma_five.ttf","FontSize"=>6));

$myPicture->drawBarChart(array("DisplayValues"=>TRUE,"DisplayColor"=>DISPLAY_AUTO,"Rounded"=>TRUE,"Surrounding"=>60));



}

 function get_data($player){
 	$player = mysql_real_escape_string($player);
 	$get_sql = "SELECT * FROM player_info WHERE BINARY name = '$player'";
 	$result = mysql_query($get_sql) or trigger_error(mysql_error());

 	$result = mysql_fetch_assoc($result);

 	$player_data = array($result['rpg'],$result['bpg'],$result['tpg'],$result['apg'],$result['spg']);
 
 	
 	return $player_data;

 }
 $avg = get_average_ppg();
 


 $player_data = get_data($name);


$MyData->addPoints($player_data,"ScoreA");
//$MyData->setSerieDrawable("BarPlot", FALSE);

function draw_horizontal_chart($values,$MyData,$myPicture){

	/* Create the pChart object */
//$myPicture = new pImage(200,500,$MyData);


$myPicture->setGraphArea(800,60,950,190);



$myPicture->setFontProperties(array("FontName"=>"pChart2.1.4/pChart2.1.4/fonts/pf_arma_five.ttf","FontSize"=>6));

$myPicture->drawScale(array("CycleBackground"=>TRUE,"DrawSubTicks"=>TRUE,"GridR"=>0,"GridG"=>0,"GridB"=>0,"GridAlpha"=>10, "Pos"=>SCALE_POS_TOPBOTTOM)); 


$myPicture->drawBarChart(array("DisplayPos"=>LABEL_POS_INSIDE,"DisplayValues"=>TRUE,"Rounded"=>TRUE,"Surrounding"=>30));
}
function draw_radar_chart($SplitChart,$myPicture,$MyData){

//$MyData->setSerieDrawable("Labels", TRUE);
//$MyData->setAbscissa("Labels");
//$MyData->setSerieDrawable("BarPlot",FALSE);
$MyData->addPoints(array("BPG","RPG","TPG","APG","SPG"),"Labels");
$MyData->setAbscissa("Labels");


$myPicture->setGraphArea(10,25,340,225);



$Options = array("Layout"=>RADAR_LAYOUT_CIRCLE, "LabelPos"=>RADAR_LABELS_HORIZONTAL, "BackgroundGradient"=>array("StartR"=>255,"StartG"=>255,"StartB"=>255,"StartAlpha"=>50,"EndR"=>32,"EndG"=>109,"EndB"=>174,"EndAlpha"=>30));

$SplitChart->drawRadar($myPicture,$MyData,$Options);

}

draw_radar_chart($SplitChart,$myPicture,$MyData);
//$MyData->RemoveSerie("Labels");
$MyData->setAbscissa(array("10,20"));
$MyData->setSerieDrawable("Labels", FALSE);
$MyData->setSerieDrawable("ScoreA", FALSE);
 draw_bar_chart($avg,$MyData,$myPicture);
 draw_horizontal_chart($avg,$MyData,$myPicture);


/* Write down the legend */
$myPicture->setFontProperties(array("FontName"=>"pChart2.1.4/pChart2.1.4/fonts/pf_arma_five.ttf","FontSize"=>6));

$myPicture->drawLegend(270,205,array("Style"=>LEGEND_BOX,"Mode"=>LEGEND_HORIZONTAL));

 
$text = preg_replace('/\s+/', '', $name);
$_SESSION['name'] = $text;

/* Render the picture */
$myPicture->Render($text.'.png');
header("Location:test.php");

}

else{
	header("Location:test.php");
}
