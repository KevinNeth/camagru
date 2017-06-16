<?php

class CommentaryModel extends Model {

	public function sendcom($login, $id_picture, $com) {
		$this->query("INSERT INTO `commentary` (`id_com`, `id_picture`, `login`, `commentary`, `date`) VALUES (NULL, '" . $id_picture . "', '" . $login . "', '" . $com . "', NOW());", Commentary);
	}
}