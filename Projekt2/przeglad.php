
<?php
include_once 'ObslugaBazy.php';
include_once 'menu.php';
session_start();
$user = new Register_new;
$baza = new ObslugaBazy;
?>

<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
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
		}else{
		Menu::$isUserAuthorized = false;
		}
		 $menu->withActiveElement("przeglad");
		 $menu->printMenu(); 
		 ?>
     </ul>
    </nav>
    <div class="page_content">
      <?php
	  if($user->_is_logged()){
			$baza->wyswietl();
			$baza->analyze();
		}else{
			echo '<p>Nie jesteś zalogowany by przeglądać zawartość.</p>';
		}
	  ?> 
    </div>
    <div id = "footer">
    <p>Karolina Kędzior 2017  </p>
    </div>
</div>
</body>
</html>