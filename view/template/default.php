<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel= "stylesheet" href= "/<?= $this->req->path ?>/view/css/default.css">
		<!-- A faire !! Crée une variable de récupération du dossier css.-->
		<title>Camagru</title>
	</head>
	<body>
		<div id = "Header">
			<!-- Création de Logo : http://eu4.fr.flamingtext.com/net-fu/dynamic.cgi?script=water-logo&text=Sign+Up&fontsize=200&fillTextType=1&fillTextPattern=Blue+Bar -->
			<img src="/<?= $this->req->path ?>/img/Camagru Logo.png" id = "Logo">
		</div>
		<?= $content_for_default; ?>
	</body>
</html>
