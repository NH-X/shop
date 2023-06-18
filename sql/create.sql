CREATE database if not exists Shop;

use Shop;

create table if not exists shop_admin(
    `_id` int not null primary key AUTO_INCREMENT,
    `user_name` varchar(255) not null,
    `password` varchar(255) not null
);

create table if not exists shop_member(
    `mem_id` int not null primary key AUTO_INCREMENT,
    `mem_name` varchar(255) not null,
    `men_pwd` varchar(255) not null,
    `mem_tname` varchar(255) not null,
    `mem_address` varchar(255) not null,
    `mem_phone` varchar(255) not null,
    `mem_email` varchar(255) not null
);

create table if not exists shop_type(
	`type_id` int not null primary key auto_increment,
	`type_name` varchar(255) not null 
);

create table if not exists shop_prod(
	`prod_id` int not null primary key auto_increment,
	`type_id` int not null,
	`prod_name` varchar(255) not null,
	`prod_img` varchar(255) not null,
	`prod_price` int not null,
	`prod_discount` int,
	`prod_content` text
);

create table if not exists shop_car(
	`car_id` int not null primary key auto_increment,
	`mem_id` varchar(255) not null,
	`prod_id` int not null,
	`prodnum` int not null,
	`prodprice` int not null,
	`prodtotal` int not null,
	`date_add` date not null,
	`prodname` varchar(255) not null,
	`prodcontent` text not null
);