<?php


class Register {

   protected $data = array()  ;

   function __construct () { 
   }
      
   function _read () {
      $this->data['nick'] = $_POST['nick'] ;
      $this->data['email']  = $_POST['email'] ;
      $this->data['haslo'] = $_POST['haslo1'];
   }          

}

class Register_new extends Register {

private $user = "4kedzior";
private $pass = "pass";
private $host = "pascal.fis.agh.edu.pl";
private $base = "4kedzior";
private $coll = "usersList";
private $conn;
private $dbase;
private $collection;

function __construct () {
	parent::__construct() ;
	$this->conn = new Mongo("mongodb://{$this->user}:{$this->pass}@{$this->host}/{$this->base}");
	$this->dbase = $this->conn->selectDB($this->base);
	$this->collection = $this->dbase->selectCollection($this->coll);  
}

function _is_logged() {
	if ( isset ( $_SESSION['auth'] ) ) { 
		$ret = $_SESSION['auth'] == 'OK' ? true : false ;
	} else { $ret = false ; } 
	return $ret ;
} 

private function select() {
	$cursor = $this->collection->find();
	$table = iterator_to_array($cursor);
	return $table ;
}

function _login() {
	$access = false ;
	$email = $_POST['email'] ;
	$pass  = $_POST['haslo'] ;
	$query = array('email' => $email);
	$count = $this->collection->findOne($query);
	if(count($count)){  
		$this->data = $count;
		if ( $this->data['haslo'] == $pass ){
		$_SESSION['auth'] = 'OK' ;
		$_SESSION['user'] = $email ; //okresla nazwe kolekcji zwiazanej z zalogowanym uzytkownikiem
		$access = true ;
     }           
	}
	if($access=="true"){
		header('Location:index2.php');
	}else{
		$text = "Błędny login lub hasło.";
	}
	return $text ;
}

function _logout() {
	unset($_SESSION); 
	session_destroy();   
   }

function _save () {
	$query = array('email' => $this->data['email']);
	$count = $this->collection->findOne($query);

	if(!count($count)){             
		$this->collection->insert($this->data);
		$text = "Rejestracja zakończyła się sukcesem.";
	}else{
		$text = "Podany email istnieje w bazie.";
	}
	return $text;
}  

private function insert($user) {
	$ret = $this->collection->insert($user) ;
	return $ret;
}



}
?>
