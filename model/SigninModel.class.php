<?php

class SigninModel extends Model {

	public function select($elem, $class_name) {
		$res = $this->query("SELECT $elem FROM users", $class_name);
		return ($res);
	}

	public function selectpass($login, $class_name) {
		$res = $this->query("SELECT password FROM users WHERE login = '$login'", $class_name);
		return ($res);
	}

	public function selectemailconf($login, $class_name) {
		$res = $this->query("SELECT email_confirmed FROM users WHERE login = '$login'", $class_name);
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
