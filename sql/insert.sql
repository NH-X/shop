use Shop;

#
insert into shop_admin  (
user_name,
`password` 
)
values(
	'admin',
	'admin'
);

#
INSERT INTO shop_member  (
    mem_name,
    men_pwd ,
    mem_tname,
    mem_address,
    mem_phone,
    mem_email
) VALUES (
	'追梦人-小道',
	'123456',
	'张三',
	'海南省海口市美兰区琼山大道19号',
	'17589823865',
	'1709597110@gmail.com'
);

#
INSERT INTO shop_prod  (
    type_id ,
	prod_name ,
    prod_img ,
    prod_price ,
    prod_discount ,
    prod_content 
) VALUES (
	2,
	'绿水鬼',
	'/Users/mac_xnh/PHP_word/www/shop/images/b1.jpg',
	259999,
	254999,
	'你值得拥有'
);

#
insert into shop_type (
	type_name
)values(
	'手表'
),(
	'首饰'
),(
	'手机/电脑'
),(
	'包包'
);

#
insert into shop_car (
	mem_id,
	prod_id,
	prodnum,
	prodprice,
	prodtotal,
	`date_add`,
	prodname,
	prodcontent
)values(
	'追梦人小道',
	1,
	1,
	259999,
	259999,
	'2023-06-18',
	'绿水鬼',
	'你值得拥有'
);