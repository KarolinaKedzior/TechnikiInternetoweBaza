<?php

include_once 'Register_new.php' ;
include_once 'menu.php' ;
session_start() ;
$user = new Register_new;

if(isset($_POST['email'])){
	$reg = new Register_new ;
	$reg->_read();
	if($_POST['haslo1']==$_POST['haslo2']){
		$_SESSION['ok'] = 'ok';
	}
	else{
		$_SESSION['errorHaslo'] = "Podane hasła nie są takie same";
	}
}
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
		 $menu->withActiveElement("register")->printMenu();
		 ?>
     </ul>
    </nav>
    <div class="page_content">
    <form method="post">
	         <table class= "formularz">
			<tr><th>Nick:</th><td><input type="text" name="nick"></td></tr>
	        <tr><th>E-mail:</th><td><input type="email" name="email"></td></tr>
	        <tr><th>Hasło:</th><td><input type="password" name="haslo1"></td></tr>
			<tr><th>Powtórz hasło:</th><td><input type="password" name="haslo2"></td></tr>
			 <?php
			if(isset($_SESSION['errorHaslo'])){
				echo '<div class="error">'.$_SESSION['errorHaslo'].'</div>';	
				unset($_SESSION['errorHaslo']);
			}
		?>
		
		 </table>
		 <input type="submit" value="Zarejestruj">
	</form> 
	<?php
		if(isset($_SESSION['ok'])){
			echo $reg->_save();
			$_SESSION = array() ;
			session_destroy();
		}
	?>  
    </div>
    <div id = "footer">
    <p>Karolina Kędzior 2017  </p>
    </div>
</div>
</body>
</html>