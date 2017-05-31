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
		 $menu->withActiveElement("index");
		 $menu->printMenu();	 
		 ?>
     </ul>
    </nav>
    <div class="page_content">
     <article>
     <h1>Techniki Internetowe - Projekt 2</h1>
      <?php
	  if($user->_is_logged()){
			echo '<p>Witaj zalogowany</p>';
			$user->_logout();
		
		}else{
			echo '<p>Niniejsza strona jest poświecona jest bazie przechowującej ankiety dotyczące czytania książek.
			<br>Aby stworzyć własna bazę należy najpierw się zarejestrować, a następnie zalogować do serwisu. Dla testu można skorzystać z istniejącego konta<br>mail: aa@aa.pl , hasło: aa </p>';
		}
			
	  ?> 
		
    </article>
    </div>
    <div id = "footer">
    <p>Karolina Kędzior 2017  </p>
    </div>
</div>
</body>
</html>