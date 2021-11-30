/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.4.14-MariaDB : Database - clinique
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`clinique` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `clinique`;

/*Table structure for table `clients` */

DROP TABLE IF EXISTS `clients`;

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `nom` char(50) NOT NULL,
  `prenom` char(50) NOT NULL,
  `age` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telephone` varchar(10) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `code_` varchar(8) NOT NULL,
  `banque` varchar(11) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `Clients_compte_FK` FOREIGN KEY (`id`) REFERENCES `compte` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `clients` */

insert  into `clients`(`id`,`nom`,`prenom`,`age`,`email`,`telephone`,`photo`,`pseudo`,`code_`,`banque`) values (8,'RABE','Marcellin',17,'marcellin.rabe@esti.mg','0349394698','images/profile.png','marcellinp20','1234','12345678910');

/*Table structure for table `compte` */

DROP TABLE IF EXISTS `compte`;

CREATE TABLE `compte` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(50) NOT NULL,
  `code_` varchar(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

/*Data for the table `compte` */

insert  into `compte`(`id`,`pseudo`,`code_`) values (8,'marcellinp20','1234'),(9,'marcellin','12345');

/*Table structure for table `demandes` */

DROP TABLE IF EXISTS `demandes`;

CREATE TABLE `demandes` (
  `id_rdv` int(11) NOT NULL,
  `id_docteur` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  PRIMARY KEY (`id_rdv`,`id_docteur`,`id_client`),
  KEY `Demande_Docteurs0_FK` (`id_docteur`),
  KEY `Demande_Clients1_FK` (`id_client`),
  CONSTRAINT `Demande_Clients1_FK` FOREIGN KEY (`id_client`) REFERENCES `clients` (`id`),
  CONSTRAINT `Demande_Docteurs0_FK` FOREIGN KEY (`id_docteur`) REFERENCES `docteurs` (`id`),
  CONSTRAINT `Demande_rendez_vous_FK` FOREIGN KEY (`id_rdv`) REFERENCES `rdv` (`id_rdv`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `demandes` */

/*Table structure for table `docteurs` */

DROP TABLE IF EXISTS `docteurs`;

CREATE TABLE `docteurs` (
  `id` int(11) NOT NULL,
  `nom` char(50) NOT NULL,
  `prenom` char(50) NOT NULL,
  `age` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telephone` varchar(10) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `specialite` char(50) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `code_` varchar(8) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `Docteurs_compte_FK` FOREIGN KEY (`id`) REFERENCES `compte` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `docteurs` */

/*Table structure for table `rdv` */

DROP TABLE IF EXISTS `rdv`;

CREATE TABLE `rdv` (
  `id_rdv` int(11) NOT NULL AUTO_INCREMENT,
  `jour` date DEFAULT curdate(),
  `heure_fin` time NOT NULL,
  `heure_debut` time NOT NULL,
  PRIMARY KEY (`id_rdv`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4;

/*Data for the table `rdv` */

insert  into `rdv`(`id_rdv`,`jour`,`heure_fin`,`heure_debut`) values (1,'2021-09-22','10:00:00','00:00:00'),(2,'2021-09-22','10:00:00','00:00:00'),(3,'2021-09-22','12:00:00','00:00:00'),(4,'2021-09-24','12:00:00','00:00:00'),(5,'2021-09-22','19:01:13','19:01:11'),(6,'2021-09-22','19:38:05','19:02:05'),(7,'2021-09-22','00:00:00','19:03:28'),(8,'2021-09-22','00:00:00','19:04:14'),(9,'2021-09-22','00:00:00','19:05:24'),(10,'2021-09-22','19:05:40','19:05:35'),(11,'2021-09-22','19:42:16','19:06:16'),(12,'2021-09-22','20:09:50','19:09:50'),(13,'2021-09-01','02:00:00','02:00:00'),(14,'2021-08-31','13:00:00','12:00:00'),(15,'2021-08-31','13:00:00','12:00:00'),(16,'2021-09-01','03:00:00','02:00:00'),(17,'2021-09-02','08:00:00','07:00:00'),(18,'2021-08-31','10:00:00','09:00:00'),(19,'2021-08-31','10:00:00','09:00:00'),(20,'2021-09-03','08:00:00','07:00:00'),(21,'2021-08-31','11:00:00','10:00:00'),(22,'2021-09-01','08:00:00','07:00:00'),(23,'2021-09-02','13:00:00','12:00:00'),(24,'2021-09-02','13:00:00','12:00:00'),(25,'2021-09-02','13:00:00','12:00:00'),(26,'2021-09-02','18:00:00','17:00:00'),(27,'2021-09-02','18:00:00','17:00:00'),(28,'2021-09-02','18:00:00','17:00:00'),(29,'2021-09-02','18:00:00','17:00:00'),(30,'2021-09-02','18:00:00','17:00:00'),(31,'2021-09-02','18:00:00','17:00:00'),(32,'2021-09-02','18:00:00','17:00:00'),(33,'2021-09-02','18:00:00','17:00:00'),(34,'2021-09-02','18:00:00','17:00:00'),(35,'2021-09-04','08:00:00','07:00:00'),(36,'2021-09-04','08:00:00','07:00:00'),(37,'2021-09-03','13:00:00','12:00:00'),(38,'2021-09-03','13:00:00','12:00:00');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
