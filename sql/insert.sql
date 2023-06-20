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
	1,
	'绿水鬼',
	'./imagesb1.jpg',
	259999,
	254999,
	'你值得拥有'
),(
	1,
	'绿水鬼1',
	'./imagesb2.jpg',
	259999,
	254999,
	'你值得拥有'
),(
	1,
	'绿水鬼2',
	'./imagesb3.jpg',
	259999,
	254999,
	'你值得拥有'
),(
	1,
	'绿水鬼3',
	'./imagesb4.jpg',
	259999,
	254999,
	'你值得拥有'
),(
	1,
	'绿水鬼4',
	'./imagesb5.jpg',
	259999,
	254999,
	'你值得拥有'
),(
	1,
	'绿水鬼5',
	'./imagesb6.jpg',
	259999,
	254999,
	'你值得拥有'
),(
	4,
	'LV',
	'./imagesbaobao1.jpg',
	23999,
	23999,
	'驴牌包包👛你值得拥有'
),(
	4,
	'LV',
	'./imagesbaobao2.jpg',
	23999,
	23999,
	'驴牌包包👛你值得拥有'
),(
	4,
	'LV',
	'./imagesbaobao3.jpg',
	23999,
	23999,
	'驴牌包包👛你值得拥有'
),(
	4,
	'LV',
	'./imagesbaobao4.jpg',
	23999,
	23999,
	'驴牌包包👛你值得拥有'
),(
	4,
	'LV',
	'./images/baobao5.jpg',
	23999,
	23999,
	'驴牌包包👛你值得拥有'
),(
	4,
	'LV',
	'./imagesbaobao6.jpg',
	23999,
	23999,
	'驴牌包包👛你值得拥有'
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