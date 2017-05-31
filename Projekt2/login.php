<?php
include_once 'menu.php' ;
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
		 $menu->withActiveElement("zaloguj");
		 $menu->printMenu();	 
		?>
     </ul>
    </nav>
    <div class="page_content">
	<form method="post" >
      <table class= "formularz">
	  <tr><th>Mail:</th><td> <input type="text" name="email" ></td></tr>
      <tr><th>Hasło:</th><td> <input type="text" name="haslo" ></td></tr>
	  </table>
      <input type="submit" name="zaloguj" value="Zaloguj"><br>
	</form>
	<?php
	if(isset($_POST['zaloguj']))
	{
		$reg = new Register_new ;
		$_SESSION['ok'] = 'ok';
		$_SESSION['zalogowany'] = true;
		echo $reg->_login();	
	} 
	?>	
    </div>
    <div id = "footer">
    <p>Karolina Kędzior 2017  </p>
    </div>
</div>
</body>
</html>