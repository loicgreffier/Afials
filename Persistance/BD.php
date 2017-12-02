<?php
class BD{

	private static $sdbh = null;
	private static $instance = null;
	
	private function __construct(){
		
		require('./Config/Config.php');
		$db_name = 'mysql:host=localhost;dbname='.$base.'';
		$db_user = $login;
		$db_password = $mdp;

		self::$sdbh = new PDO($db_name, $db_user, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'));
	}
	
	public static function getInstance(){

		if (self::$instance == null)
			self::$instance = new self;
		return self::$instance;
	}
	
	public function query($requete, $param){

		$statement = self::$sdbh->prepare($requete);
		if(!$statement) { return false; }
		if(isset($param)){
			for($i = 1; $i <= count($param); $i++){
				$statement->bindParam($i,$param[$i][0],$param[$i][1]);	
			}		
			$statement->execute();
			return $statement;
		}
	}

	public function getResult($statement){ return $statement->fetch(); }
	public function getResults($statement){ return $statement->fetchAll(); }
}

?>