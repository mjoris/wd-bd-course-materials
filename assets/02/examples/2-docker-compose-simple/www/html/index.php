<?php

	try {
		$db = new PDO('mysql:host=db;dbname=moviedb;charset=utf8mb4', 'root', 'Azerty123');
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql ="CREATE TABLE IF NOT EXISTS persons (
				 id INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
				 firstname VARCHAR( 50 ) NOT NULL, 
				 lastname VARCHAR( 250 ) NOT NULL,
				 country VARCHAR( 50 ) NOT NULL);" ;
		$db->exec($sql);
		$query = $db->query('SHOW TABLES;');
        print_r($query->fetchAll(PDO::FETCH_COLUMN));
	} catch (PDOException $e) {
		echo $e->getMessage();
	}



?>