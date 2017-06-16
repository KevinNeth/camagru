<?php

class CommentaryController extends Controller {
	
	public function send() {
		$this->sendindb($_SESSION['login'], $_POST['id_picture'], $_POST['commentary']);//proteger sql.
		header('Location: http://localhost:8080/' . $this->req->path . '/gallery/view');
	}

	public function sendindb($login, $id_picture, $com) {
		require 'config/database.php';
		$db = new CommentaryModel($DB_DSN, $DB_USR, $DB_PSW);
		$db->sendcom($login, $id_picture, $com);
	}
}

?>