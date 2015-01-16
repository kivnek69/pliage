<?php 

//dates : mer 11h59 -> jeu 3h58

$sources = array(
		//"Cartodb/10.json"
		//,
		//"Cartodb/11.json"
		//,
		//"Cartodb/12.json"
		//,
		//"Cartodb/13.json" //europe?
		//,
		//"Cartodb/20.json" //europe?
		//,
		//"Cartodb/21.json" //pacifique?
		//,
		//"Cartodb/22.json"
		//,
		//"Cartodb/23.json"
		//,
		"Cartodb/30.json"
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
		//$x = round(($json[$i]['x__uint8']/127 - 2)*90+90*($k%4));
		//$y = round(($json[$i]['y__uint8']/127 - 2)*90+90*($k%4));
		
		$x = round(($json[$i]['x__uint8']/127)*120 - 60);
		$y = round(($json[$i]['y__uint8']/127)*90 - 45);

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

		$tableau_valeurs[] = $x;
		$tableau_valeurs[] = $y;
		$tableau_valeurs[] = ($valeur/2000);
	}

}


$final = array(array("1990", $tableau_valeurs));

$json_final = json_encode($final);
file_put_contents($fichier_final, $json_final);

?>

<!DOCTYPE HTML>
<html lang="en">
  <head>
    <title>Carte numéro 7</title>
    <meta charset="utf-8">
    <style type="text/css">
      html {
        height: 100%;
      }
      body {
        margin: 0;
        padding: 0;
        color: #ffffff;
        font-family: sans-serif;
        font-size: 13px;
        line-height: 20px;
        height: 100%;
      }

      #currentInfo {
        width: 270px;
        position: absolute;
        left: 20px;
        top: 63px;

        background-color: rgba(0,0,0,0.2);

        border-top: 1px solid rgba(255,255,255,0.4);
        padding: 10px;
      }

      a {
        color: #aaa;
        text-decoration: none;
      }
      a:hover {
        text-decoration: underline;
      }
      
      #title {
        position: absolute;
        top: 20px;
        width: 270px;
        left: 20px;
        background-color: rgba(0,0,0,0.2);
        border-radius: 3px;
        font: 20px Georgia;
        padding: 10px;
      }

      .year {
        font: 16px Georgia;
        line-height: 26px;
        height: 30px;
        text-align: center;
        float: left;
        width: 90px;
        color: rgba(255, 255, 255, 0.4);

        cursor: pointer;
        -webkit-transition: all 0.1s ease-out;
      }

      .year:hover, .year.active {
        font-size: 23px;
        color: #fff;
      }
      
      #carte{
      	width: 700px;
      	height: 700px;
        background: #ffaaaa url(loading.gif) center center no-repeat;
      }
    </style>
  </head>
  <body>
	<div id="carte">
	  <div id="container"></div>
	
	  <div id="currentInfo">
	    <span id="year1990" class="year">07/01</span>
	    <span id="year1995" class="year">08/01</span>
	    <span id="year2000" class="year">09/01</span>
	  </div>
	
	  <div id="title">
	    #JeSuisCharlie
	  </div>
	</div>
  <script type="text/javascript" src="http://data-arts.appspot.com/globe/third-party/Three/ThreeWebGL.js"></script>
  <script type="text/javascript" src="http://data-arts.appspot.com/globe/third-party/Three/ThreeExtras.js"></script>
  <script type="text/javascript" src="http://data-arts.appspot.com/globe/third-party/Three/RequestAnimationFrame.js"></script>
  <script type="text/javascript" src="http://data-arts.appspot.com/globe/third-party/Three/Detector.js"></script>
  <script type="text/javascript" src="http://data-arts.appspot.com/globe/third-party/Tween.js"></script>
  <script type="text/javascript" src="http://data-arts.appspot.com/globe/globe.js"></script>
  <script type="text/javascript">

    if(!Detector.webgl){
      Detector.addGetWebGLMessage();
    } else {

      var years = ['1990'];
      var container = document.getElementById('container');
      var globe = new DAT.Globe(container);
      console.log(globe);
      var i, tweens = [];

      var settime = function(globe, t) {
        return function() {
          new TWEEN.Tween(globe).to({time: t/years.length},500).easing(TWEEN.Easing.Cubic.EaseOut).start();
          var y = document.getElementById('year'+years[t]);
          if (y.getAttribute('class') === 'year active') {
            return;
          }
          var yy = document.getElementsByClassName('year');
          for(i=0; i<yy.length; i++) {
            yy[i].setAttribute('class','year');
          }
          y.setAttribute('class', 'year active');
        };
      };

      for(var i = 0; i<years.length; i++) {
        var y = document.getElementById('year'+years[i]);
        y.addEventListener('mouseover', settime(globe,i), false);
      }

      var xhr;
      TWEEN.start();


      xhr = new XMLHttpRequest();
      xhr.open('GET', 'Cartodb/date1.json', true);
      xhr.onreadystatechange = function(e) {
        if (xhr.readyState === 4) {
          if (xhr.status === 200) {
            var data = JSON.parse(xhr.responseText);
            window.data = data;
            //data[0] = tableau pour la date 0
            //data[0][0] nom de la date 0
            //data[0][1] valeurs pour la date 0
            //data[0][1][0]->1ere latitude
            //data[0][1][1]->1ere longitude
            //data[0][1][2]->1ere valeur
            for (i=0;i<data.length;i++) {
              globe.addData(data[i][1], {format: 'magnitude', name: data[i][0], animated: true});
            }
            globe.createPoints();
            settime(globe,0)();
            globe.animate();
          }
        }
      };
      xhr.send(null);
    }

  </script>
  </body>

</html>
