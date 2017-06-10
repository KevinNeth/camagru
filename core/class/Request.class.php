<?php
class Request {

	private $url;

	public function __construct() {
		$this->url = $_SERVER['REQUEST_URI'];//Récupération de l'URL.
	}
	public function getUrl() {
		return $this->url;
	}
}
?>
