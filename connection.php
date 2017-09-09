<?php
	try
	{
	 $dsn = "mysql:host=localhost;dbname=distancelearning";
	 $db = new PDO ($dsn, "webuser", "webpass");
	}
	catch (PDOException $e)
	{
	 print ("Cannot connect to server\n");
	 print ("Error code: " . $e->getCode () . "\n");
	 print ("Error message: " . $e->getMessage () . "\n");
	}
	?>