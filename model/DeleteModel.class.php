<?php
class DeleteModel extends Model {
	public function delPic($path) {
		$this->query("DELETE FROM picture WHERE path_picture ='" . $path ."';");
	}
}

?>