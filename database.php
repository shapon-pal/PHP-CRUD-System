<?php 

include 'config.php';

/**
* Make Database Connection
*/
class DB
{
	private static $pdo;
    private static function connection()
    {
    	if (!isset(self::$pdo)) 
    	{
    		try 
    		{
    			self::$pdo = new PDO('mysql:host='.DB_HOST.'; dbname='.DB_NAME,DB_USER,DB_PASS); 			
    		} catch (PDOException $e) 
    		{
    			echo $e->getMessage();
    		}		
    	}

        return self::$pdo;
    	
    }

    public static function prepare_crud($query)
    {
        return self::connection()->prepare($query);
    }  
}