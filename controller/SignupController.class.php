<?php
class SignupController extends Controller {
	public function check() {
		//Vérification de l'username.
		$this->set("verif", 1);
		if (!preg_match("#^\w{3,9}$#", $_POST["login"]))
		{
			$this->set("login", "L'username doit être comprit entre 3 et 9 caractères.");
			$this->vars["verif"] = 0;
		}
		//Verification de l'adress e-mail.
		if (!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST["email"]))
		{
			$this->set("email", "L'Email est invalide.");
			$this->vars["verif"] = 0;
		}
		//Verification du mdp.
		if (!preg_match("#^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$#", $_POST["passwd"]))
		{
			// ^: anchored to beginning of string
			// \S*: any set of characters
			// (?=\S{8,}): of at least length 8
			// (?=\S*[a-z]): containing at least one lowercase letter
			// (?=\S*[A-Z]): and at least one uppercase letter
			// (?=\S*[\d]): and at least one number
			// $: anchored to the end of the string
			$this->set("passwd", "Le mot de passe doit contenir au moin 8 caractères, une majuscule, une minuscule et un chiffre.");
			$this->vars["verif"] = 0;
		}
		//APPEL DU MODEL POUR AJOUTER LE NOUVELLE UTILISATEUR;
		if ($this->vars["verif"] === 1) {
			if ($this->checklogin("login", "Users") === 1 && $this->checkemail("email", "Users") === 1)
			{
				require 'config/database.php';
				$db = new SignupModel($DB_DSN, $DB_USR, $DB_PSW);
				$securepsw = hash("whirlpool", $_POST['passwd']);
				$res = $db->insert($_POST['login'], $securepsw, $_POST['email']);
				$this->sendEmail($_POST);
				$this->set("valid", "Incription valider, pour activer votre compte merci de cliquer sur le lien présent dans l'email de validation =D.");
			}
			else {
				if ($this->checklogin("login", "Users") === 0)
					$this->vars['login'] = "Users déja pris.";
				if ($this->checkemail("email", "Users") === 0)
					$this->vars['email'] = "Email déjà pris.";
			}
		}
		$this->render('form');
		die();
	}

	public function checklogin($elem, $class_name) {
		require 'config/database.php';
		$db = new SignupModel($DB_DSN, $DB_USR, $DB_PSW);
		$res = $db->select($elem, $class_name);
		foreach ($res as $try) {
			if (strcmp($try->login, $_POST["login"]) === 0) {
				return (0);
			}
		}
		return (1);
	}

	public function checkemail($elem, $class_name) {
		require 'config/database.php';
		$db = new SignupModel($DB_DSN, $DB_USR, $DB_PSW);
		$res = $db->select($elem, $class_name);
		foreach ($res as $try) {
			if (strcmp($try->email, $_POST["email"]) === 0) {
				return (0);
			}
		}
		return (1);
	}

	private function sendEmail($userinfo)
	{
		$emailTo = htmlspecialchars($userinfo['email']);
		$emailFrom = 'test@camagru.com';
		$subject = "Camagru - Confirm Your Account";
		$message = "To create your account, confirm by clicking on the link below <br/> <a href='http://localhost:". PORT . DS . $this->req->path . "/verisignup/validEmail/" . $_POST['login'] . "'>Confirm account</a>";
		$headers = "From: " . $emailFrom . "\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		mail($emailTo, $subject, $message, $headers);
	}
}
?>
