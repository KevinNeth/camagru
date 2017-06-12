<?php

class GalleryController extends Controller {
	
	public function view() {
		$allPic = $this->galleryprev();
		foreach ($allPic as $pic) {
			$this->vars["gallery"] .= '<div><img class="img_preview" src="../' . $pic->path_picture . '">';
			$allCom = $this->comprev($pic->id_picture);
			echo '<pre>';
			var_dump($allCom[0]);
			echo '</pre>';

			if (isset($allCom[0]) === true) {
				foreach ($allCom as $com) {
					$this->vars["gallery"] .= '<p>' . $com->commentary . '</p><br><p>by ' . $com->login . '</p><br><p>date: ' . $com->date . '</p>';
				}
			}
			else {
				$this->vars["gallery"] .= '<p>Aucun commentaire sur cette photo. Soyer la premiere personne a la commenter !</p>';
			}
		}

		$this->render('gallery');
	}

	public function galleryprev() {
		require 'config/database.php';
		$db = new GalleryModel($DB_DSN, $DB_USR, $DB_PSW);
		$allPic = $db->takegall();
		return($allPic);
	}

	public function comprev($id_picture) {
		require 'config/database.php';
		$db = new GalleryModel($DB_DSN, $DB_USR, $DB_PSW);
		$allCom = $db->takecom($id_picture);
		return($allCom);
	}
}

?>