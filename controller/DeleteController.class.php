<?php
class DeleteController extends Controller {
	public function del_pic() {
		require 'config/database.php';
		$db = new DeleteModel($DB_DSN, $DB_USR, $DB_PSW);
		$db->delPic($_POST["Supprimer"]);
		header('Location: http://localhost:8080/' . $this->req->path . '/cam/view');
	}
}

?>