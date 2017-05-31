
<?php
include_once 'Register_new.php' ;

	class MenuItem
	{
		public $id;
		public $url;
		public $caption;
		public $authorized;

		static function createAuthorized($id, $url, $caption)
		{
			$item = new MenuItem();
			$item->id = $id;
			$item->url = $url;
			$item->caption = $caption;
			$item->authorized = true;
			return $item;
		}

		static function create($id, $url, $caption)
		{
			$item = new MenuItem();
			$item->id = $id;
			$item->url = $url;
			$item->caption = $caption;
			$item->authorized = false;
			return $item;
		}
	}

	class Menu
	{
		private $items;
		private $activeElementId;
		static $isUserAuthorized;

		public function __construct()
		{
			$this->items = array(
				MenuItem::create("index", "index.php", "Strona Główna"),
				MenuItem::create("register", "rejestracja.php", "Rejestracja"),
				MenuItem::create("zaloguj", "login.php", "Zaloguj"),
				MenuItem::create("offline", "offline.html", "Zapisz Offline"),
				MenuItem::createAuthorized("index2", "index2.php", "Strona Głowna"),
				MenuItem::createAuthorized("przeglad", "przeglad.php", "Przegląd Bazy"),
				MenuItem::createAuthorized("dodaj", "dodaj.php", "Dodaj Rekord"),
				MenuItem::createAuthorized("wyloguj", "logout.php", "Wyloguj")
			);
		}

		public function withActiveElement($activeElementId)
		{
			$this->activeElementId = $activeElementId;
			return $this;
		}

		public function printMenu()
		{
			foreach($this->items as $item)
			{
				if($item->authorized && !Menu::$isUserAuthorized || !$item->authorized && Menu::$isUserAuthorized)
				{
					continue;
				}

				if($item->id == $this->activeElementId)
				{
					echo "<li ><a href='" . $item->url . "'  class='active' >" . $item->caption . "</a></li>";
				} 
				else
				{
					echo "<li><a href='" . $item->url . "'>" . $item->caption . "</a></li>";
				}

			}
		}
	}

	Menu::$isUserAuthorized=false;
?>



