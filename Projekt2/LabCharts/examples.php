<?php
include_once('./LabChartsBar.php');
include_once('./LabChartsLine.php');
include_once('./LabChartsPie.php');

$LabChartsPie = new LabChartsPie();
$LabChartsPie->setData(array(100, 200, 200, 200, 430, 760, 54));
//$LabChartsPie->setType('p3');
$LabChartsPie->setTitle('Udziały w pewnej firmie');
$LabChartsPie->setSize('400x200');
$LabChartsPie->setColors('D9351C');
$LabChartsPie->setLabels('Marek|Franek|Michał|Lech|Jarosław|Grzesiek|Tomek');

$LabChartsBar = new LabChartsBar();
$LabChartsBar->setData(array(85.8,57.5, 16.7, 5, 1.7));
$LabChartsBar->setSize('400x200');
$LabChartsBar->setTitle('Przychody w poszczególnych miesiącach');
//$LabChartsBar->setColors('D9351C|FAAC02|79D81C|2A9DF0|02AA9D');
$LabChartsBar->setLabels('Styczen|Luty|Marzec|Kwiecien|Maj');
$LabChartsBar->setBarStyles(40);
$LabChartsBar->setAxis(10);
$LabChartsBar->setGrids(10);


$LabChartsLine = new LabChartsLine();
$LabChartsLine->setData(array(7,15,50,21,15,29,15,21,16,-23,4,18,17,21,17,19,16,25,62,15));
$LabChartsLine->setColors('D9351C');
$LabChartsLine->setSize('400x250');
$LabChartsLine->setTitle('Zyski w poszczególnych miesiącach');
$LabChartsLine->setAxis (20, 'Sty||Mar||Maj||Lip||Wrz||Lis||Sty||Mar||Maj||Lip|');
$LabChartsLine->setGrids (10);

?>

<html>
<head>
<title>Laboratorium kodu - LabCharts</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Tangerine">
<style>
body {
	font-family: 'Tangerine', serif;
	font-size: 48px;
}
</style>
</head>
<body>

<p>Wykres kołowy:</p>
<img src="<?=$LabChartsPie->getChart()?>">

<p>Wykres słupkowy:</p>
<img src="<?=$LabChartsBar->getChart()?>">

<p>Wykres liniowy:</p>
<img src="<?=$LabChartsLine->getChart()?>">

</body>
</html>
