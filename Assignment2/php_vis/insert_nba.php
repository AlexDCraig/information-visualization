<?php

$user = 'root';
$pass ='' ; 
$db = 'nba';

mysql_connect('localhost',$user,$pass);

mysql_select_db($db);
echo " database is connected". "<br/>";

$data = array(array('name'=>'','age'=>'','team'=>'','games'=>'','wins'=>'','loss'=>'','ppg'=>'','bpg'=>'','rpg'=>'','apg'=>'','spg'=>'','tpg'=>'','fpg'=>''));

$parsed_data = array_map('str_getcsv',file('Document2.csv'));
$i = 1;


foreach ($parsed_data as $key => $value) {
	# code...
		if($key == 0){
			unset($data[0]);
			continue;
		}
		else{

		$data[$key]['name'] = $value[0]." ".$value[1];
		$data[$key]['team'] = $value[2];
		$data[$key]['age'] = $value[3];
		$data[$key]['games'] = $value[4];
		$data[$key]['wins'] = $value[5];
		$data[$key]['loss'] = $value[6];
		$data[$key]['ppg'] = $value[7];
		$data[$key]['bpg'] = $value[22];
		$data[$key]['rpg'] = $value[20];
		$data[$key]['apg'] = $value[21];
		$data[$key]['tpg'] = $value[22];
		$data[$key]['spg'] = $value[23];
/*
		if($key == 10){
		
			unset($data[0]);
			break;
		}
		*/
}
}

foreach($data as $key => $value)
{

$name = mysql_escape_string($value['name']);
$team = mysql_escape_string($value['team']);
$wins = mysql_escape_string($value['wins']);
$loss = mysql_escape_string($value['loss']);
$games = mysql_escape_string($value['games']);
$age = mysql_escape_string($value['age']);
$ppg = mysql_escape_string($value['ppg']);
$bpg = mysql_escape_string($value['bpg']);
$rpg = mysql_escape_string($value['rpg']);
$apg = mysql_escape_string($value['apg']);
$tpg = mysql_escape_string($value['tpg']);
$spg = mysql_escape_string($value['spg']);

$ins_sql = "INSERT INTO player_info (name,age,team_name,wins,loss,ppg,bpg,rpg,apg,tpg,spg,games) VALUES ('$name','$age','$team','$wins','$loss','$ppg','$bpg','$rpg','$apg','$tpg','$spg','$games')";

$result = mysql_query($ins_sql) or trigger_error(mysql_error());
	
}

	if($result == 1){
		echo "successful"; 
	}

	


//echo "data is";
//var_dump($data);
