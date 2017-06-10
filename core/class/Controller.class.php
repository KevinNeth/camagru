<?php
class Controller {

	protected $req;
	protected $vars = array();

	public function __construct($req) {
		$this->req = $req;//Récupération des infos crée par le routeur.
	}

	//Méthode qui affiche la page et qui récupère les variables crée.
	public function render($view) {
		extract($this->vars);
		if(strpos($view, '/') === 0)//On regarde si '/' est au début de view.
		{
			$view = ROOT . DS . 'view' . $view . '.php';
		}
		else
		{
			$view = ROOT
			. DS . 'view' . DS . 'elem' . DS . $view . '.php';
		}
		ob_start();
		require $view;
		$content_for_default = ob_get_clean();
		require ROOT . DS . 'view' . DS . 'template' . DS . 'default.php';

	}

	//Méthode qui crée les variables.
	public function set($key, $value) {
		$this->vars[$key] = $value;
	}

}
?>
