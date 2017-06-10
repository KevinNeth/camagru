<?php
class SignupModel extends Model {

	//Changer les query avec prepare.
	public function select($elem, $class_name) {
		$res = $this->query("SELECT $elem FROM users", $class_name);
		return ($res);
	}

	public function insert($login, $passwd, $email) {
		$this->query("INSERT INTO `users`(`login`, `password`, `email`, `email_confirmed`, `admin`)
		VALUES ('$login', '$passwd', '$email', 'no', 'no');");
	}

	public function update($column, $value, $login) {
		$this->query("UPDATE users SET $column = '$value' WHERE login = '$login';");
	}
}
?>
