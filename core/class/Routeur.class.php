<?php
class Routeur {

	public function parse($url, $req) {
		$url = trim($url, '/');
		$param = explode('/', $url);//Tableau contenant l'URL.
		$req->path = $param[0];
		if (isset($param[1]) && !empty($param[1]))
			$req->controller = $param[1];//Création de la variable controller.
		else
			$req->controller = 'form';
		if (isset($param[2]) && !empty($param[2]))//Création de la variable action set à index si null.
			$req->action = $param[2];
		else
			$req->action = 'form';
		$req->params = array_slice($param, 3);//Création du tableau params contenant le reste de l'URL.
		return true;
	}
}
?>
