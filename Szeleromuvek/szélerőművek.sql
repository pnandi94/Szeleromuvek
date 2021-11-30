CREATE DATABASE szeleromuvek;

CREATE TABLE `megye` (
  `id` int(10) NOT NULL PRIMARY KEY auto_increment,
  `nev` varchar(20) NOT NULL,
  `regio` varchar(20) NOT NULL
); 

CREATE TABLE `helyszin` (
  `id` int(10) NOT NULL PRIMARY KEY auto_increment,
  `nev` varchar(20) NOT NULL,
  `megyeid` int(10) NOT NULL,
  FOREIGN KEY (`megyeid`) REFERENCES `megye`(`id`)
);

CREATE TABLE `torony` (
  `id` int(10) NOT NULL PRIMARY KEY auto_increment,
  `db` int(10) NOT NULL,
  `teljesitmeny` int(10) NOT NULL,
  `kezdev` int(10) NOT NULL,
  `helyszinid` int(10) NOT NULL,
  FOREIGN KEY (`helyszinid`) REFERENCES `helyszin`(`id`)
)

ENGINE = INNODB
CHARACTER SET utf8 COLLATE utf8_general_ci;

