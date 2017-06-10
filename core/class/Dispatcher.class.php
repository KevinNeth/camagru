<?php
class Dispatcher {

	private $req;

	public function __construct($DB_DSN, $DB_USR, $DB_PSW) {
		require ROOT . '/config/setup.php';//Crée la base de donnée au demmarage du site (à enlevée en situation réel)
		$this->req = new Request();//Création de l'objet Request.
		$url = $this->req->getUrl();//Récupération de l'URL.
		Routeur::parse($url, $this->req);//Transformation de l'URL.
		$controller = $this->loadController();
		if (!in_array($this->req->action, get_class_methods($controller)))
			$this->error();
		call_user_func_array(array($controller, $this->req->action), $this->req->params);
	}

	public function error() {
		header("HTTP/1.0 404 Not Found");
		$controller = new Controller($this->req);
		$controller->render('/error/404');
		die();
	}

	public function loadController() {
		$name = ucfirst($this->req->controller).'Controller';//Nom de la class controller.
		$file = ROOT . DS . 'controller' . DS . $name . '.class.php';
		require $file;//Appel du fichier correspondant a la class controller.
		$controller = new $name($this->req);//Instanciation du controller.
		return $controller;
	}
}
?>
