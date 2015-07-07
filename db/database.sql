create database if not exists babydressing character set utf8 collate utf8_unicode_ci;
use babydressing;

grant all privileges on babydressing.* to 'baby_user'@'localhost' identified by 'secret';