<?php

class SigninController extends Controller {

	public function check() {
		$login =  $_POST['login'];
		$securepsw = hash("Whirlpool", $_POST['passwd']);
		//Check dans la base de donnée ou se trouve le login puis check
		if ($this->checklogin("login", $login, "Users") === 0) {
			if ($this->checkpasswd($login, $securepsw, "Users") === 0) {
				if ($this->verifemail($login, "Users") === 0) {
					$_SESSION['login'] = $login;
					header('Location: http://localhost:8080/' . $this->req->path . '/cam/view');
				}
				else {
					$this->vars['valid'] = "Pour pouvoir profiter de toute les fonctionaliters du site, merci de cliquer sur le lien de confirmation reçu dans l'email de confirmation !";
				}
			}
			else {
				$this->set("passwd2", "MDP Invalide.");
			}
		}
		else {
			$this->set("login2", "Utilisateur introuvable.");
		}
		$this->render('form');
		die();
	}

	public function checklogin($elem, $login, $class_name) {
		require 'config/database.php';
		$db = new SigninModel($DB_DSN, $DB_USR, $DB_PSW);
		$res = $db->select($elem, $class_name);
		foreach ($res as $try) {
			if (strcmp($try->login, $login) === 0) {
				return (0);
			}
		}
		return (1);
	}

	public function checkpasswd($login, $passwd, $class_name) {
		require 'config/database.php';
		$db = new SigninModel($DB_DSN, $DB_USR, $DB_PSW);
		$res = $db->selectpass($login, $class_name);
		foreach ($res as $try) {
			if (strcmp($try->password, $passwd) === 0) {
				return (0);
			}
		}
		return (1);
	}

	public function verifemail($login, $class_name) {
		require 'config/database.php';
		$db = new SigninModel($DB_DSN, $DB_USR, $DB_PSW);
		$res = $db->selectemailconf($login, $class_name);
		foreach ($res as $try) {
			if (strcmp($try->email_confirmed, "yes") === 0) {
				return (0);
			}
		}
		return (1);
	}
}

?>
