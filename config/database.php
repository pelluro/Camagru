<?php
require_once dirname(__FILE__)."/functions/connection_install.php";

if(!mysqli_query($db, "USE boutiques"))
{
	mysqli_query($db, "CREATE DATABASE boutiques");
}
mysqli_query($db, "USE boutiques");

/*****************************
 * la table des utilisateurs
 *****************************/

$query = "CREATE TABLE users_shop (
    id INT AUTO_INCREMENT,
    username varchar(255),
    password varchar(512) NOT NULL,
    PRIMARY KEY(id)
)";
check_query($db, $query);
$query = "
INSERT INTO users_shop(username,password) VALUES
('no_user','no_user'),
('toto','toto'),
('tata','tata'),
('bob','bob')
";
check_query($db, $query);

/*****************************
 * la table des categories
 *****************************/
$query = "
CREATE TABLE category_shop (
    id INT AUTO_INCREMENT,
    PRIMARY KEY (id),
    name varchar(255) NOT NULL
)
";
check_query($db, $query);

$query = "
INSERT INTO category_shop(name) VALUES
('homme'),
('femme'),
('enfant'),
('pull'),
('chaussures')
";

check_query($db, $query);
/*****************************
 * la table des produits
 *****************************/

$query = "CREATE TABLE product_shop (
    id INT AUTO_INCREMENT,
    PRIMARY KEY (id),
    name varchar(255) NOT NULL,
    price float NOT NULL,
	imglink varchar(1000)
)";
check_query($db, $query);

$query= "INSERT INTO product_shop(name,price,imglink) VALUES
('pull rose',20,'http://static1.puretrend.com/articles/2/19/09/72/@/2005572--624x0-1.jpg'),
('pantalon vert',29.99,'https://www.pantalon-new-park.com/boutique/images_produits/jeans-vert2.jpg'),
('chaussures',10.99,'http://photo3.i-run.fr/salomon-s-lab-xa-alpine-m-chaussures-homme-135326-1-fb.jpg'),
('manteau',40.99,'https://valanga.ca/wp-content/uploads/2017/10/manteau_femme_amely.jpg')
";
check_query($db, $query);
/*****************************
 * creation card shop
 *****************************/

$query = "CREATE TABLE card_shop (
    id INT AUTO_INCREMENT,
    PRIMARY KEY(id),
	state INT DEFAULT 0,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES users_shop(id) ON DELETE CASCADE
)";
check_query($db, $query);

/*****************************
 * creation card shop product
 *****************************/
$query = "CREATE TABLE card_shop_product (
    card_shop_id INT,
    FOREIGN KEY (card_shop_id) REFERENCES card_shop(id) ON DELETE CASCADE,
    product_id INT,
    FOREIGN KEY (product_id) REFERENCES product_shop(id) ON DELETE CASCADE,
    amount INT NOT NULL
    )";
check_query($db, $query);

/*****************************
 * creation categories product
 *****************************/
$query = "CREATE TABLE categories_product (
    category_id INT,
    FOREIGN KEY (category_id) REFERENCES category_shop(id) ON DELETE CASCADE,
    product_id INT,
    FOREIGN KEY (product_id) REFERENCES product_shop(id) ON DELETE CASCADE
    )";
check_query($db, $query);
