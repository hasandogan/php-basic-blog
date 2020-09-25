create table if not exists admin
(
	id int auto_increment,
	username varchar(255) not null,
	password varchar(255) null,
	user_type varchar(255) null,
	name varchar(255) null,
	lastname varchar(255) null,
	constraint admin_id_uindex
		unique (id),
	constraint admin_username_uindex
		unique (username)
);

alter table admin
	add primary key (id);

create table if not exists article
(
	id int auto_increment
		primary key,
	slug varchar(255) null,
	title varchar(255) null,
	author varchar(255) null,
	content text null,
	createdAt datetime null,
	updateAt datetime null,
	image_path text not null,
	constraint article_slug_uindex
		unique (slug)
);

create table if not exists article_categories
(
	id int auto_increment
		primary key,
	articleid int null,
	categoriesid int null
);

create table if not exists categories
(
	id int auto_increment,
	name varchar(255) not null,
	page_title varchar(255) not null,
	content varchar(255) null,
	meta_desc varchar(255) null,
	meta_key varchar(255) null,
	constraint categories_id_uindex
		unique (id),
	constraint categories_name_uindex
		unique (name)
);

alter table categories
	add primary key (id);

create table if not exists comments
(
	id int auto_increment
		primary key,
	username varchar(255) not null,
	content text null,
	confirmed tinyint(1) default 0 null,
	articleid int null,
	CreatedAt datetime null,
	articletitle varchar(255) null
);

create table if not exists search
(
	id int auto_increment
		primary key,
	name varchar(255) null
);

create table if not exists tags
(
	id int auto_increment
		primary key,
	articleid int null,
	tag_name varchar(255) not null
);

create table if not exists user
(
	id int auto_increment
		primary key,
	firstname varchar(255) null,
	lastname varchar(255) null,
	username varchar(255) null,
	email varchar(255) null,
	pass varchar(255) not null comment 'user
',
	constraint user_email_uindex
		unique (email),
	constraint user_username_uindex
		unique (username)
);

