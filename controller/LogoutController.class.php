<?php
class LogoutController extends Controller {
	function logout() {
		$_SESSION['login'] = "";
		header('Location: http://localhost:8080/' . $this->req->path);
	}
}
?>