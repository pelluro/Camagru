<?php
include "database_setup.php";
$req = 'CREATE DATABASE IF NOT EXISTS camagru; 
	USE camagru;
    CREATE TABLE IF NOT EXISTS users (      id INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
                                            email VARCHAR(64) NOT NULL,
                                            login VARCHAR(16) NOT NULL,
                                            passwd VARCHAR(128) NOT NULL,
                                            token VARCHAR(128) NOT NULL, 
                                            verified INT(1) NOT NULL default "0" );
    CREATE TABLE IF NOT EXISTS pictures (   id INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
                                            filename VARCHAR(19) NOT NULL default "",
                                            filedate DATETIME NOT NULL,
                                            user_id INT NOT NULL,
                                            FOREIGN KEY (user_id) REFERENCES users(id));
    CREATE TABLE IF NOT EXISTS comments (   id INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
                                            comment VARCHAR(250) NOT NULL default "",
                                            user_id INT NOT NULL,
                                            pic_id INT NOT NULL,
                                            date DATETIME NOT NULL,
                                            FOREIGN KEY (user_id) REFERENCES users(id),
                                            FOREIGN KEY (pic_id) REFERENCES pictures(id));
    CREATE TABLE IF NOT EXISTS likes    (   id INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
                                            user_id INT NOT NULL,
                                            pic_id INT NOT NULL,
                                            FOREIGN KEY (user_id) REFERENCES users(id),
                                            FOREIGN KEY (pic_id) REFERENCES pictures(id));
    CREATE TABLE IF NOT EXISTS paramusers ( user_id INT(11) NOT NULL,
                                            param_name VARCHAR(256) NOT NULL,
                                            param_value VARCHAR(256) NOT NULL,
                                            FOREIGN KEY (user_id) REFERENCES users(id),
                                            PRIMARY KEY (user_id, param_name))';
$dbConnection->prepare($req)->execute();
?>