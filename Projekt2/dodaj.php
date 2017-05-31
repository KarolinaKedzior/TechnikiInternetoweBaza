<?php
include_once 'menu.php';
include_once 'ObslugaBazy.php';
session_start();
$user = new Register_new;
$baza = new ObslugaBazy;
?>

<html>
<head>
<meta charset="UTF-8">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
<script src="offlinedb.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body onload="load()">
<div class="page" id="page">
     <nav style="position: relative" >
      <h1 class="toph">Ankieta</h1>
      <img src="logo.png" alt="Empty" class = "logo">
      <div class ="linebreak"></div>
     <ul class="menu">
       <?php 
		$menu = new Menu(); 
		if($user->_is_logged() ){
			Menu::$isUserAuthorized = true;
		}
		 $menu->withActiveElement("dodaj");
		 $menu->printMenu(); 
		 ?>
     </ul>
    </nav>
    <div class="page_content">
      <form id="form" method="post">
        <p>Płeć</p>
        <p><input type="radio" name="gender" value="male" checked> Mężczyzna
        <input type="radio" name="gender" value="female"> Kobieta
        <p>Ile książek przeczytałeś/aś w ostatnim roku.<input type="number" min = "0" name="ilosc" value="3" /></p>
        <p>Jakiego gatunku książki czytasz najczęściej?</p>
		<select name="gatunek" >
        <option value="">Wybierz gatunek:</option>
        <option value="1">Kryminalne</option>
       <option value="2">Horror</option>
       <option value="3">Poradnik</option>
       <option value="4">Fantasy</option>
       <option value="5">Przygodowe</option>
       </select>
        <p><input type="submit" id="wyslij" value="Zatwierdź"/></p>
    </form>
    <div id="info"></div>
	
	<button onclick="synchronizuj()">SYNCHRONIZUJ</button>
	<?php
		if(isset($_POST['gender'])){		
			echo $baza->_save();	
		}
	?>
	
    </div>
    <div id = "footer">
    <p>Strona stworzona w ramach zajęć z Baz Danych, Karolina Kędzior 2017  </p>
    </div>
</div>
</body>
</html>