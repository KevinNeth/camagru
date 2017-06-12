<?php
class FormController extends Controller {

	//Sous-controller qui va gérer toute les actions lier à la page et l'afficher.
	// public function view($nom) {
		// $this->render($nom);//Appel de la page.
	// }
	public function form() {
		if ($_SESSION['login']) {
			header('Location: http://localhost:8080/' . $this->req->path . '/gallery/view');
		}
		else {
			$this->render('form');
		}
	}
}
?>
