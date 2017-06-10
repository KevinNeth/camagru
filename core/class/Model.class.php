<?php
class Model
{
	private $pdo;
	private $db_name;
	private $db_usr;
	private $db_psw;

	public function __construct($DB_NAME, $DB_USR, $DB_PSW)
	{
		$this->db_name = 'mysql:host=localhost';
		$this->db_usr = $DB_USR;
		$this->db_psw = $DB_PSW;
		$this->getPDO()->query('CREATE DATABASE IF NOT EXISTS camagru');
		$this->db_name = $DB_NAME;
		$this->pdo = null;
	}

	private function getPDO()
	{
		if ($this->pdo === NULL) //Connection a la base de donnée.
		{
			$pdo = new PDO($this->db_name, $this->db_usr, $this->db_psw);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Affichage des erreurs.
			$this->pdo = $pdo;
		}
		return $this->pdo;
	}

	public function query($statement, $class_name = null)
	{
		$req = $this->getPDO()->query($statement); //Requête a la base de donnée.
		if (strpos($statement, 'UPDATE') === 0 ||
			strpos($statement, 'CREATE') === 0 ||
			strpos($statement, 'INSERT') === 0 ||
			strpos($statement, 'DELETE') === 0)
		{
			return null;
		}
		$req->setFetchMode(PDO::FETCH_CLASS, $class_name); //Récuperation de la requête en un tableau d'objets d'une classe précise.
		//Liaison de la base de donnée à la classe.
		$datas = $req->fetchAll();
		return $datas;
	}

	public function prepare($statement, $attribute, $class_name , $one = false)//Protection contre les injections SQL lorsqu'une variable est mise dans une requête.
	{
		$req = $this->getPDO->prepare($statement);//Prepare une requête SQL.
		//Prépare une requête SQL à être exécutée par la méthode PDOStatement::execute().
		//La requête SQL peut contenir zéro ou plusieurs noms (:nom) ou marqueurs (?) pour lesquels les valeurs réelles seront substituées lorsque la requête sera exécutée.
		//Vous ne pouvez pas utiliser les marqueurs nommés et les marqueurs interrogatifs dans une même requête SQL ; choisissez l'un ou l'autre.
		//Utilisez ces paramètres pour lier les entrées utilisateurs, ne les incluez pas directement dans la requête.
		//Vous devez inclure un marqueur avec un nom unique pour chaque valeur que vous souhaitez passer dans la requête lorsque vous appelez PDOStatement::execute().
		//Vous ne pouvez pas utiliser un marqueur avec deux noms identiques dans une requête préparée, à moins que le mode émulation ne soit actif.
		$req->execute($attribute);//Execute la requête préparer avec l'attribut donnée.
		$req->setFetchMode(PDO::FETCH_CLASS, $class_name);//Initialisation du FetchMode pour retournée les objets avec une class précises.
		if ($one)//Choix entre un seul objet ou un tableau d'objets.
		{
			$datas = $req->fetch(); //Récupération de la requête en un objet.
		}
		else
		{
			$datas = $req->fetchAll(); //Récuperation de la requête en un tableau d'objets d'une classe précise.
		}
		return $datas;
	}
}

?>
