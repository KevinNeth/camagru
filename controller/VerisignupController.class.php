<?php
class VerisignupController extends Controller {

	public function validEmail() {
		$login = $this->req->params[0];
		if ($this->checklog($login) === 0) {
			require 'config/database.php';
			$db = new SignupModel($DB_DSN, $DB_USR, $DB_PSW);
			$db->update('email_confirmed', 'yes', $login);
			$this->set("valid", "Email confirmer bienvenu sur notre site, connecter vous pour accedez a tous les contenus !");
		}
		else {
			$this->set("valid", "User introuvable !");
		}
		$this->render('form');
		die();
	}

	public function checklog($login) {
		require 'config/database.php';
		$db = new SignupModel($DB_DSN, $DB_USR, $DB_PSW);
		$res = $db->select('login', "Users");
		foreach ($res as $try) {
			if (strcmp($try->login, $login) === 0) {
				return (0);
			}
		}
		return (1);
	}
}
?>
