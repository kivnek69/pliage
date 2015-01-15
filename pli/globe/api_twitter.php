<?php
$sources = array(
			"Cartodb/10.json"
		/*
		 ,
			"Cartodb/11.json",
			"Cartodb/12.json",
			"Cartodb/13.json",
			"Cartodb/20.json",
			"Cartodb/21.json",
			"Cartodb/22.json",
			"Cartodb/23.json",
			"Cartodb/30.json"
			//*/
			);

$fichier_final = "Cartodb/date1.json";

$tableau_valeurs = array();

$min_x = 50;
$max_x = 50;
$min_y = 50;
$max_y = 50;
$min_date = 50;
$max_date = 50;

for($k = 0; $k < count($sources); $k++){
	$file = file_get_contents($sources[$k]);
	
	$json = json_decode($file, true);
	
	for($i = 0; $i < count($json); $i++){
		$x = round((($json[$i]['x__uint8']/127)-0.5)*360);
		$y = round((($json[$i]['y__uint8']/127)-0.5)*360);
		
		if($x < $min_x)
			$min_x = $x;
		if($x > $max_x)
			$max_x = $x;
		if($y < $min_y)
			$min_y = $y;
		if($y > $max_y)
			$max_y = $y;
		
		$valeur = 0;
		for($j = 0; $j < count($json[$i]['dates__uint16']); $j++){
			//if($json[$i]['dates__uint16'][$j] < 100)
			$date = $json[$i]['dates__uint16'][$j];
			
			if($date < $min_date)
				$min_date = $date;
			if($date > $max_date)
				$max_date = $date;
			
			$valeur += $json[$i]['vals__uint8'][$j];
		}

		if($valeur > 0){
			if(!isset($tableau_valeurs[$x][$y]))
				$tableau_valeurs[$x][$y] = 0;
			$tableau_valeurs[$x][$y] += ($valeur/1000);
		
			echo "x: ".$x." - y: ".$y." - valeur: ".($valeur/1000)."<br/>";
		}
	}
	
}

sort($tableau_valeurs);
print_r($tableau_valeurs);


echo "<br>Min x : ".$min_x;
echo "<br>Max x : ".$max_x;
echo "<br>Min y : ".$min_y;
echo "<br>Max y : ".$max_y;
echo "<br>Min date : ".$min_date;
echo "<br>Max date : ".$max_date;

echo "<br>";

//$final = array(array("1990", $tableau_valeurs));

//$json_final = json_encode($final);
//file_put_contents($fichier_final, $json_final);

//print_r($json_final);