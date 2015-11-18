/*
SQLyog Community v12.16 (64 bit)
MySQL - 5.6.17 : Database - devinvanwart
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`devinvanwart` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `devinvanwart`;

/*Table structure for table `customers` */

DROP TABLE IF EXISTS `customers`;

CREATE TABLE `customers` (
  `Email` varchar(80) NOT NULL,
  `FName` varchar(80) NOT NULL,
  `LName` varchar(80) NOT NULL,
  `Title` varchar(10) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `HomeTele` varchar(50) NOT NULL,
  `WorkTele` varchar(50) DEFAULT NULL,
  `Address1` varchar(255) NOT NULL,
  `Address2` varchar(255) DEFAULT NULL,
  `Province` varchar(80) NOT NULL,
  `ccType` varchar(80) NOT NULL,
  `ccNumber` varchar(20) NOT NULL,
  `ccName` varchar(100) NOT NULL,
  `ccMonth` int(11) NOT NULL,
  `ccYear` int(11) NOT NULL,
  `LanguagePref` varchar(50) NOT NULL,
  `InterestSpaceX` tinyint(1) DEFAULT NULL,
  `InterestTesla` tinyint(1) DEFAULT NULL,
  `InterestHyper` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `customers` */

insert  into `customers`(`Email`,`FName`,`LName`,`Title`,`Password`,`HomeTele`,`WorkTele`,`Address1`,`Address2`,`Province`,`ccType`,`ccNumber`,`ccName`,`ccMonth`,`ccYear`,`LanguagePref`,`InterestSpaceX`,`InterestTesla`,`InterestHyper`) values 
('admin@yoursite.com','Admin','Admin','Mr','$2y$10$YyH6/G02/cu2xpUb.ugZ8eMSWvoDs3Wnm3hsc5YM8UrV1wtnH5Crm','555-555-5555','','00 Null','','Alberta','American Express','111111111111111','ADMIN',1,2025,'English',0,0,0),
('devin.vanwart@gmail.com','Devin','Vanwart','Mr','$2y$10$AEIPwVfvpqO056/mvSjmx.LNVjg7XhiT7klF8yEQU6UP1WbTu684W',' 15068472755',' 15068472755','590 Montgomery st.','apt 4','New Brunswick','Visa','111111111111111','DEVIN VANWART',1,2020,'English',0,0,0);

/*Table structure for table `orderlines` */

DROP TABLE IF EXISTS `orderlines`;

CREATE TABLE `orderlines` (
  `OrderLineID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `OrderID` int(10) unsigned NOT NULL,
  `ProductCode` char(7) NOT NULL,
  `Quantity` int(10) unsigned NOT NULL,
  PRIMARY KEY (`OrderLineID`),
  KEY `OrderID` (`OrderID`),
  KEY `ProductCode` (`ProductCode`),
  CONSTRAINT `orderlines_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`OrderID`),
  CONSTRAINT `orderlines_ibfk_2` FOREIGN KEY (`ProductCode`) REFERENCES `products` (`ProductCode`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `orderlines` */

insert  into `orderlines`(`OrderLineID`,`OrderID`,`ProductCode`,`Quantity`) values 
(1,1,'LOOP004',1);

/*Table structure for table `orders` */

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `OrderID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Email` varchar(80) NOT NULL,
  PRIMARY KEY (`OrderID`),
  KEY `Email` (`Email`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`Email`) REFERENCES `customers` (`Email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `orders` */

insert  into `orders`(`OrderID`,`Email`) values 
(1,'devin.vanwart@gmail.com');

/*Table structure for table `pageids` */

DROP TABLE IF EXISTS `pageids`;

CREATE TABLE `pageids` (
  `PageID` char(3) NOT NULL,
  `Department` varchar(50) NOT NULL,
  `Category` varchar(50) NOT NULL,
  `Meta` varchar(255) NOT NULL,
  PRIMARY KEY (`PageID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pageids` */

insert  into `pageids`(`PageID`,`Department`,`Category`,`Meta`) values 
('100','SpaceX','Manned','Reserve your manned launch with Space X'),
('101','SpaceX','SharedCargo','Reserve a porton of a cargo launch to Space X'),
('102','SpaceX','HeavyCargo','Reserve a cargo rocket for heavy lifting'),
('200','Hyperloop','Cargo','Find hyperloop cargo soloutions to fit your needs'),
('201','Hyperloop','Passanger','Get tickets for Hyperloop transit'),
('202','Hyperloop','Merch','Get Hyperloop merchandise and gifts'),
('300','Tesla','ModelS','Find the Model S for you!'),
('301','Tesla','ModelX','Find the model X for you!'),
('302','Tesla','Merch','Get Tesla merchandise and gifts');

/*Table structure for table `products` */

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `ProductCode` char(7) NOT NULL,
  `AltImageRef` char(7) DEFAULT NULL,
  `ProductName` varchar(255) DEFAULT NULL,
  `ProductDescription` varchar(1000) DEFAULT NULL,
  `Category` varchar(255) DEFAULT NULL,
  `Department` varchar(255) DEFAULT NULL,
  `ThumbHeight` int(11) DEFAULT NULL,
  `Price` double DEFAULT NULL,
  `SalePrice` double DEFAULT NULL,
  `SaleStart` date DEFAULT NULL,
  `SaleEnd` date DEFAULT NULL,
  `Feature1` varchar(255) DEFAULT NULL,
  `Feature2` varchar(255) DEFAULT NULL,
  `Feature3` varchar(255) DEFAULT NULL,
  `Feature4` varchar(255) DEFAULT NULL,
  `NumInStock` int(11) DEFAULT NULL,
  PRIMARY KEY (`ProductCode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `products` */

insert  into `products`(`ProductCode`,`AltImageRef`,`ProductName`,`ProductDescription`,`Category`,`Department`,`ThumbHeight`,`Price`,`SalePrice`,`SaleStart`,`SaleEnd`,`Feature1`,`Feature2`,`Feature3`,`Feature4`,`NumInStock`) values 
('LOOP001',NULL,'Hyperloop Mug','High quality Hyperloop mug','Merch','Hyperloop',100,10,NULL,NULL,NULL,NULL,NULL,NULL,NULL,35),
('LOOP002',NULL,'Hyperloop T-Shirt','Styleish Hyperloop T-shirt','Merch','Hyperloop',100,20,NULL,NULL,NULL,NULL,NULL,NULL,NULL,15),
('LOOP003',NULL,'Hyperloop Hoodie','Comfortable Hyperloop hoodie','Merch','Hyperloop',100,40,NULL,NULL,NULL,NULL,NULL,NULL,NULL,10),
('LOOP004',NULL,'Light Cargo','One car of light cargo such as foodstuffs','Cargo','Hyperloop',60,10000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),
('LOOP005',NULL,'Heavy Cargo','One car of heavy cargo such as steel','Cargo','Hyperloop',38,20000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),
('LOOP006',NULL,'Enterprise Cargo','On demand use of hyperloop cargo services, additional feesmay apply','Cargo','Hyperloop',56,100000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),
('LOOP007',NULL,'Ticket','One way hyperloop ticket','Passanger','Hyperloop',62,20,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),
('LOOP008',NULL,'20 Ticket Card','Economical ticket pack','Passanger','Hyperloop',64,350,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),
('LOOP009',NULL,'Monthly Pass','Unlimited monthly pass','Passanger','Hyperloop',55,200,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),
('LOOP010',NULL,'Hyperloop Poster','A fitting poster for any Hyperloop fan','Merch','Hyperloop',34,10,NULL,NULL,NULL,'Ships in sturdy tube',NULL,NULL,NULL,50),
('LOOP011',NULL,'Hyperloop Map','Map of future hyperloop tranportation lines','Merch','Hyperloop',59,15,NULL,NULL,NULL,'Ships in sturdy tube','Own the future!',NULL,NULL,30),
('SPCX001','SPCX001','Crewed ISS Launch','Crewed Dragon Capsule to the ISS','Manned','SpaceX',150,175000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),
('SPCX002','SPCX001','Crewed LEO Launch','Crewed Dragon Capsule to low earth orbit','Manned','SpaceX',150,150000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),
('SPCX003','SPCX001','Crewed Lunar Landing','Crewed Dragon Capsule with landing module to moon','Manned','SpaceX',150,300000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),
('SPCX004','SPCX002','Shared Cargo Launch to ISS','Shared space on a cargo mission to the ISS','SharedCargo','SpaceX',133,50000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),
('SPCX005','SPCX002','Shared Cargo Lauch to LEO','Shared space on launch to low earth orbit','SharedCargo','SpaceX',133,40000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),
('SPCX006','SPCX002','Shared Cargo Launch to GeoStationary','Shared Space on launch to geostationary orbit','SharedCargo','SpaceX',133,70000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),
('SPCX007','SPCX003','Cargo LEO Launch','Cargo launch to low earth orbit','HeavyCargo','SpaceX',150,200000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),
('SPCX008','SPCX003','Cargo Lunar Launch','Cargo launch for surface of moon','HeavyCargo','SpaceX',150,400000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),
('SPCX009','SPCX003','Cargo Mars Launch','Cargo launch to mars orbit','HeavyCargo','SpaceX',150,1000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),
('TESL001',NULL,'Model S P85D','-nice desc-','ModelS','Tesla',61,120000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),
('TESL002',NULL,'Model S P85','Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. N','ModelS','Tesla',61,100000,NULL,NULL,NULL,'test1','test2','test3',NULL,20),
('TESL003',NULL,'Model S 70D','--','ModelS','Tesla',55,82000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,10),
('TESL004',NULL,'Model X P85D','--','ModelX','Tesla',56,80000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),
('TESL005',NULL,'Model X 85D','-','ModelX','Tesla',66,70000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,30),
('TESL006',NULL,'Model X 60D','-','ModelX','Tesla',108,60000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,21),
('TESL007',NULL,'Tesla Hoodie','-','Merch','Tesla',100,40,NULL,NULL,NULL,NULL,NULL,NULL,NULL,20),
('TESL008',NULL,'Tesla Mug','-','Merch','Tesla',100,10,NULL,NULL,NULL,NULL,NULL,NULL,NULL,50),
('TESL009',NULL,'Tesla T-Shirt','-','Merch','Tesla',111,20,NULL,NULL,NULL,NULL,NULL,NULL,NULL,30);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
