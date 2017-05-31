<?php
include_once('./LabCharts/LabChartsBar.php');
include_once('./LabCharts/LabChartsPie.php');

class ObslugaBazy {
private $user = "4kedzior";
private $pass = "pass";
private $host = "pascal.fis.agh.edu.pl";
private $base = "4kedzior";
private $coll ;
private $conn  ;
private $dbase ;
private $collection ;

function __construct () {
	
	$this->conn = new Mongo("mongodb://{$this->user}:{$this->pass}@{$this->host}/{$this->base}");
	$this->dbase = $this->conn->selectDB($this->base);
	$this->coll = $_SESSION['user']; // nazwa kolekcji dla uzytkownika o danym (uniwersalnym) mailu
	$this->collection = $this->dbase->selectCollection($this->coll); 
}

function _save () {
	$gender = $_POST['gender'];
	$gatunek= "Brak"; 
	$ilosc = $_POST['ilosc'];
	$q = $_POST['gatunek'];
	switch ($q) {
    case "1":
        $gatunek = "Kryminalne";
        break;
    case "2":
        $gatunek = "Horror";
        break;
    case "3":
        $gatunek = "Poradnik";
        break;
    case "4":
        $gatunek = "Fantasy";
        break;  
	case "5":
        $gatunek = "Przygodowe";
        break; 	
	default:
	}
	
	
	$cursor = $this->collection->find();
	$index = 0;
	foreach ( $cursor as $obj ) {
      		$id = $obj['numerAnkiety'];
		if((int)$id > $index){
			$index = (int)$id;			
		}
	}
	$index = $index + 1;
	$query = array('numerAnkiety' => $index,
			'date' => date("Y-m-d"),
			'gender' => $gender,
			'gatunek' => $gatunek,
			'ilosc' => $ilosc);         	
	$this->collection->insert($query);
    $text = "Dodano ankietę";
	return $text;
 } 
function wyswietl() {
	$cursor = $this->collection->find();
	echo "<table class = \"fulltable\" >";
	echo '<tr><th>Numer ankiety</th><th>Data</th><th>Płeć</th><th>Gatunek</th><th>Ilość przeczytanych książek.</th>';
      	foreach ( $cursor as $obj ) {
		echo "<tr>";
			$i = 0;
		foreach ($obj as $value) {
			if($i != 0){
    			echo "<td>".$value."</td>";
			}
			$i = $i+1;
		}
		echo "</tr>";
		
     	}
	echo "</table>";
    }
	
function analyze() {
	
      	$cursor = $this->collection->find();
	$wmen = 0;
	$men = 0;
	$wksiazki = 0;
	$mksiazki = 0;
	$k = 0;
	$por = 0;
	$h = 0;
	$p = 0;
	$f = 0;
      	foreach ( $cursor as $obj ) {
		$numerAnkiety = $obj['numerAnkiety'];
		$date = $obj['date'];
      	$gender = $obj['gender'];
		$gatunek= $obj['gatunek'];
		$ilosc = $obj['ilosc'];
		
		switch ($gatunek) {
    case "Horror":
        $h = $h+1;
        break;
    case "Kryminalne":
         $k = $k+1;
        break;
    case "Poradnik":
         $por = $por+1;
        break;
    case "Fantasy":
        $f = $f+1;
        break;  
	case "Przygodowe":
         $p = $p+1;
        break; 	
	default:
		}
		
		if($gender=="female"){
			$wmen = $wmen + 1;
			 $wksiazki = $wksiazki+$ilosc;
			
		}
		if($gender=="male"){
			$men = $men + 1;
			 $mksiazki = $mksiazki+$ilosc;	
		}
		}
	echo '<p>Liczba ankietowanych kobiet:' .  $wmen . '</p><p>Liczba ankietowanych mężczyzn: '. $men .'</p>
	<p>Średnia ilość książek czytanych w ciągu roku (wśród mężczyzn):' . $mksiazki/$men .'</p>
	<p>Średnia ilość książek czytanych w ciągu roku (wśród kobiet):' . $wksiazki/$wmen .'</p><br/>';
	echo "<p> Wykres najczęściej czytanych gatunków.</p>";
	$LabChartsPie = new LabChartsPie();
	$LabChartsPie->setData(array($h, $p, $f,$por,$k));
	$LabChartsPie->setLabels ('Horror|Przygodowe|Fantasy|Poradnik|Kryminalne');
	echo '<img src='.$LabChartsPie->getChart().' />';
    }
}
?>

