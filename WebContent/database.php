<?php
class Database
{
    private static $dbName = 'sql1702439' ;
    private static $dbHost = 'lochnagar.abertay.ac.uk' ;
    private static $dbUsername = 'sql1702439';
    private static $dbUserPassword = 'n8HXtGlbgGVg';
	 
	private static $cont  = null;
	 
	public function __construct() {
		die('Init function is not allowed');
	}
	 
	public static function connect()
	{
		// One connection through whole application
		if ( null == self::$cont )
		{
			try
			{
				self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword);
			}
			catch(PDOException $e)
			{
				die($e->getMessage());
			}
		}
		return self::$cont;
	}
	 
	public static function disconnect()
	{
		self::$cont = null;
	}
}
?>

<?php

echo "Hello";

// decode the json body from the request
$jsonbody = file_get_contents('php://input') ;
$jsonobj = json_decode($jsonbody) ;
$state = $jsonobj -> state ;
$pin = $jsonobj -> pin ;
$result = createSwitchState($state, $pin) ;

function createSwitchState($state, $pin)
{

    require 'Portfolio-1/WebContent/database.php';
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO EletricImp (Input,Pin) values(?,?)";
    $q = $pdo->prepare($sql);
    $q->execute(array(
        $state,
        $pin
    ));

}
?>
