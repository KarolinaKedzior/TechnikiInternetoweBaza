<?php
include_once 'menu.php';
session_start();
$user = new Register_new;
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
		}
		 $menu->withActiveElement("index2");
		 $menu->printMenu(); 
		 ?>
     </ul>
    </nav>
    <div class="page_content">
	<?php
		
		
		echo '<article>';
	  if($user->_is_logged()){
			echo '<p>Jesteś obecnie zalogowany</p>';
			echo '<p>Korzystając z menu możesz dodać nowy rekord oraz przeglądnąć dostępne dane z bazy.</p>';
			echo '<p>Aby dodać do bazy rekordy offline nalezy kliknąć w zakładce "Dodaj" przycisk "SYNCHRONIZUJ"</p>';
		}else{
			echo '<p>Nic tu nie ma.</p>';
		}
			echo '</article>';
	  ?> 
    </div>
    <div id = "footer">
    <p>Karolina Kędzior 2017  </p>
    </div>
</div>
</body>
</html>