-- MySQL dump 10.19  Distrib 10.3.29-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: dbAtlantik
-- ------------------------------------------------------
-- Server version	10.3.29-MariaDB-0+deb10u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Bateau`
--

DROP TABLE IF EXISTS `Bateau`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Bateau` (
  `numeroBateau` int(11) NOT NULL,
  `libelleBateau` varchar(25) DEFAULT NULL,
  `longueurBateau` float DEFAULT NULL,
  `largeurBateau` float DEFAULT NULL,
  `vitesseBateau` float DEFAULT NULL,
  `imageBateau` varchar(60) DEFAULT NULL,
  `type` char(1) DEFAULT NULL,
  PRIMARY KEY (`numeroBateau`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Bateau`
--

LOCK TABLES `Bateau` WRITE;
/*!40000 ALTER TABLE `Bateau` DISABLE KEYS */;
INSERT INTO `Bateau` VALUES (1,'Kor\' Ant',NULL,NULL,NULL,NULL,'v'),(2,'Ar Solen',NULL,NULL,NULL,NULL,'v'),(3,'Al\'xi',25,7,16,'/images/bateauVoyageur/alXi.png','v'),(4,'Luce isle',37.2,8.6,26,'/images/bateauVoyageur/luceIsle.png','v'),(5,'Maëllys',NULL,NULL,NULL,NULL,'v');
/*!40000 ALTER TABLE `Bateau` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Categorie`
--

DROP TABLE IF EXISTS `Categorie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Categorie` (
  `lettreCategorie` varchar(1) NOT NULL,
  `libelleCategorie` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`lettreCategorie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Categorie`
--

LOCK TABLES `Categorie` WRITE;
/*!40000 ALTER TABLE `Categorie` DISABLE KEYS */;
INSERT INTO `Categorie` VALUES ('A','Passager'),('B','Véh.inf.2m'),('C','Véh.sup.2m');
/*!40000 ALTER TABLE `Categorie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Contient`
--

DROP TABLE IF EXISTS `Contient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Contient` (
  `nombrePlace` int(11) DEFAULT NULL,
  `lettreCategorie` varchar(1) NOT NULL,
  `numeroBateau` int(11) NOT NULL,
  PRIMARY KEY (`lettreCategorie`,`numeroBateau`),
  KEY `numeroBateau` (`numeroBateau`),
  CONSTRAINT `Contient_ibfk_1` FOREIGN KEY (`lettreCategorie`) REFERENCES `Categorie` (`lettreCategorie`),
  CONSTRAINT `Contient_ibfk_2` FOREIGN KEY (`numeroBateau`) REFERENCES `Bateau` (`numeroBateau`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Contient`
--

LOCK TABLES `Contient` WRITE;
/*!40000 ALTER TABLE `Contient` DISABLE KEYS */;
INSERT INTO `Contient` VALUES (250,'A',1),(300,'A',2),(260,'A',3),(175,'A',4),(225,'A',5),(15,'B',1),(12,'B',2),(6,'B',3),(2,'B',4),(6,'B',5),(3,'C',1),(2,'C',2),(0,'C',3),(0,'C',4),(1,'C',5);
/*!40000 ALTER TABLE `Contient` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Equipement`
--

DROP TABLE IF EXISTS `Equipement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Equipement` (
  `numeroEquipement` varchar(20) NOT NULL,
  `libelleEquipement` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`numeroEquipement`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Equipement`
--

LOCK TABLES `Equipement` WRITE;
/*!40000 ALTER TABLE `Equipement` DISABLE KEYS */;
INSERT INTO `Equipement` VALUES ('AH','Accès Handicapé'),('B','Bar'),('PP','Pont Promenade'),('SV','Salon Vidéo');
/*!40000 ALTER TABLE `Equipement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Liaison`
--

DROP TABLE IF EXISTS `Liaison`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Liaison` (
  `codeLiaison` int(11) NOT NULL,
  `distanceLiaison` float DEFAULT NULL,
  `depart` int(11) NOT NULL,
  `arrivee` int(11) NOT NULL,
  `numeroSecteur` int(11) NOT NULL,
  PRIMARY KEY (`codeLiaison`),
  KEY `depart` (`depart`),
  KEY `arrivee` (`arrivee`),
  KEY `numeroSecteur` (`numeroSecteur`),
  CONSTRAINT `Liaison_ibfk_1` FOREIGN KEY (`depart`) REFERENCES `Port` (`numeroPort`),
  CONSTRAINT `Liaison_ibfk_2` FOREIGN KEY (`arrivee`) REFERENCES `Port` (`numeroPort`),
  CONSTRAINT `Liaison_ibfk_3` FOREIGN KEY (`numeroSecteur`) REFERENCES `Secteur` (`numeroSecteur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Liaison`
--

LOCK TABLES `Liaison` WRITE;
/*!40000 ALTER TABLE `Liaison` DISABLE KEYS */;
INSERT INTO `Liaison` VALUES (11,25.1,2,4,1),(15,8.3,1,2,1),(16,8,1,3,1),(17,7.9,3,1,1),(19,23.7,4,2,1),(21,7.7,6,7,3),(22,7.4,7,6,3),(24,9,2,1,1),(25,8.8,1,5,2),(30,8.8,5,1,2);
/*!40000 ALTER TABLE `Liaison` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Periode`
--

DROP TABLE IF EXISTS `Periode`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Periode` (
  `numeroPeriode` int(11) NOT NULL,
  `dateDebPeriode` date DEFAULT NULL,
  `dateFinPeriode` date DEFAULT NULL,
  PRIMARY KEY (`numeroPeriode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Periode`
--

LOCK TABLES `Periode` WRITE;
/*!40000 ALTER TABLE `Periode` DISABLE KEYS */;
INSERT INTO `Periode` VALUES (1,'2010-09-01','2011-06-15'),(2,'2011-06-16','2011-09-15'),(3,'2011-09-16','2012-05-31');
/*!40000 ALTER TABLE `Periode` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Port`
--

DROP TABLE IF EXISTS `Port`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Port` (
  `numeroPort` int(11) NOT NULL,
  `libellePort` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`numeroPort`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Port`
--

LOCK TABLES `Port` WRITE;
/*!40000 ALTER TABLE `Port` DISABLE KEYS */;
INSERT INTO `Port` VALUES (1,'Quiberon'),(2,'Le Palais'),(3,'Sauzon'),(4,'Vannes'),(5,'Port St Gildas'),(6,'Lorient'),(7,'Port-Tudy'),(8,'Locmaria');
/*!40000 ALTER TABLE `Port` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Posseder`
--

DROP TABLE IF EXISTS `Posseder`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Posseder` (
  `numeroBateau` int(11) NOT NULL,
  `numeroEquipement` varchar(20) NOT NULL,
  PRIMARY KEY (`numeroBateau`,`numeroEquipement`),
  KEY `numeroEquipement` (`numeroEquipement`),
  CONSTRAINT `Posseder_ibfk_1` FOREIGN KEY (`numeroBateau`) REFERENCES `Bateau` (`numeroBateau`),
  CONSTRAINT `Posseder_ibfk_2` FOREIGN KEY (`numeroEquipement`) REFERENCES `Equipement` (`numeroEquipement`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Posseder`
--

LOCK TABLES `Posseder` WRITE;
/*!40000 ALTER TABLE `Posseder` DISABLE KEYS */;
INSERT INTO `Posseder` VALUES (3,'AH'),(3,'PP'),(4,'AH'),(4,'B'),(4,'PP'),(4,'SV');
/*!40000 ALTER TABLE `Posseder` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Reservation`
--

DROP TABLE IF EXISTS `Reservation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Reservation` (
  `numeroReservation` bigint(20) NOT NULL,
  `nomReservation` varchar(25) DEFAULT NULL,
  `adresseReservation` varchar(75) DEFAULT NULL,
  `codePostalReservation` varchar(5) DEFAULT NULL,
  `villeReservation` varchar(45) DEFAULT NULL,
  `montantReservation` float DEFAULT NULL,
  `numeroTraversee` int(11) NOT NULL,
  PRIMARY KEY (`numeroReservation`),
  KEY `numeroTraversee` (`numeroTraversee`),
  CONSTRAINT `Reservation_ibfk_1` FOREIGN KEY (`numeroTraversee`) REFERENCES `Traversee` (`numeroTraversee`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Reservation`
--

LOCK TABLES `Reservation` WRITE;
/*!40000 ALTER TABLE `Reservation` DISABLE KEYS */;
INSERT INTO `Reservation` VALUES (9181458911,'TIPREZ','15 rue de l\'industrie','19290','PEYRELEVADE',209.1,541201),(9181458912,'Dupont','2 Rue des Mimosas','05000','Gap',268.1,541201);
/*!40000 ALTER TABLE `Reservation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Secteur`
--

DROP TABLE IF EXISTS `Secteur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Secteur` (
  `numeroSecteur` int(11) NOT NULL,
  `libelleSecteur` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`numeroSecteur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Secteur`
--

LOCK TABLES `Secteur` WRITE;
/*!40000 ALTER TABLE `Secteur` DISABLE KEYS */;
INSERT INTO `Secteur` VALUES (1,'Belle-Île-en-mer'),(2,'Houat'),(3,'Ile de Groix'),(4,'Ouessant'),(5,'Molène'),(6,'Sein'),(7,'Bréhat'),(8,'Batz'),(9,'Aix'),(10,'Yeu');
/*!40000 ALTER TABLE `Secteur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Tarif`
--

DROP TABLE IF EXISTS `Tarif`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Tarif` (
  `prix` float DEFAULT NULL,
  `codeTypeCategorie` varchar(2) NOT NULL,
  `numeroPeriode` int(11) NOT NULL,
  `codeLiaison` int(11) NOT NULL,
  PRIMARY KEY (`codeTypeCategorie`,`numeroPeriode`,`codeLiaison`),
  KEY `numeroPeriode` (`numeroPeriode`),
  KEY `codeLiaison` (`codeLiaison`),
  CONSTRAINT `Tarif_ibfk_1` FOREIGN KEY (`codeTypeCategorie`) REFERENCES `TypeCategorie` (`codeTypeCategorie`),
  CONSTRAINT `Tarif_ibfk_2` FOREIGN KEY (`numeroPeriode`) REFERENCES `Periode` (`numeroPeriode`),
  CONSTRAINT `Tarif_ibfk_3` FOREIGN KEY (`codeLiaison`) REFERENCES `Liaison` (`codeLiaison`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Tarif`
--

LOCK TABLES `Tarif` WRITE;
/*!40000 ALTER TABLE `Tarif` DISABLE KEYS */;
INSERT INTO `Tarif` VALUES (18,'A1',1,15),(27.2,'A1',1,19),(20,'A1',2,15),(29.3,'A1',2,19),(19,'A1',3,15),(28.5,'A1',3,19),(11.1,'A2',1,15),(17.3,'A2',1,19),(13.1,'A2',2,15),(18.6,'A2',2,19),(12.1,'A2',3,15),(18.1,'A2',3,19),(5.6,'A3',1,15),(9.8,'A3',1,19),(7,'A3',2,15),(10.6,'A3',2,19),(6.4,'A3',3,15),(10.2,'A3',3,19),(86,'B1',1,15),(129,'B1',1,19),(95,'B1',2,15),(139,'B1',2,19),(91,'B1',3,15),(135,'B1',3,19),(129,'B2',1,15),(194,'B2',1,19),(142,'B2',2,15),(209,'B2',2,19),(136,'B2',3,15),(203,'B2',3,19),(189,'C1',1,15),(284,'C1',1,19),(208,'C1',2,15),(306,'C1',2,19),(199,'C1',3,15),(298,'C1',3,19),(205,'C2',1,15),(308,'C2',1,19),(226,'C2',2,15),(332,'C2',2,19),(216,'C2',3,15),(323,'C2',3,19),(268,'C3',1,15),(402,'C3',1,19),(295,'C3',2,15),(434,'C3',2,19),(282,'C3',3,15),(422,'C3',3,19);
/*!40000 ALTER TABLE `Tarif` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Traversee`
--

DROP TABLE IF EXISTS `Traversee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Traversee` (
  `numeroTraversee` int(11) NOT NULL,
  `dateTraversee` date DEFAULT NULL,
  `heureTraversee` time DEFAULT NULL,
  `numeroBateau` int(11) NOT NULL,
  `codeLiaison` int(11) NOT NULL,
  PRIMARY KEY (`numeroTraversee`),
  KEY `numeroBateau` (`numeroBateau`),
  KEY `codeLiaison` (`codeLiaison`),
  CONSTRAINT `Traversee_ibfk_1` FOREIGN KEY (`numeroBateau`) REFERENCES `Bateau` (`numeroBateau`),
  CONSTRAINT `Traversee_ibfk_2` FOREIGN KEY (`codeLiaison`) REFERENCES `Liaison` (`codeLiaison`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Traversee`
--

LOCK TABLES `Traversee` WRITE;
/*!40000 ALTER TABLE `Traversee` DISABLE KEYS */;
INSERT INTO `Traversee` VALUES (541197,'2011-07-10','07:45:00',1,15),(541198,'2011-07-10','09:15:00',2,15),(541199,'2011-07-10','10:50:00',3,15),(541200,'2011-07-10','12:15:00',4,15),(541201,'2011-07-10','14:30:00',1,15),(541202,'2011-07-10','16:45:00',2,15),(541203,'2011-07-10','18:15:00',3,15),(541204,'2011-07-10','19:45:00',5,15);
/*!40000 ALTER TABLE `Traversee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TypeCategorie`
--

DROP TABLE IF EXISTS `TypeCategorie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TypeCategorie` (
  `codeTypeCategorie` varchar(2) NOT NULL,
  `libelleTypeCategorie` varchar(25) DEFAULT NULL,
  `lettreCategorie` varchar(1) NOT NULL,
  PRIMARY KEY (`codeTypeCategorie`),
  KEY `lettreCategorie` (`lettreCategorie`),
  CONSTRAINT `TypeCategorie_ibfk_1` FOREIGN KEY (`lettreCategorie`) REFERENCES `Categorie` (`lettreCategorie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TypeCategorie`
--

LOCK TABLES `TypeCategorie` WRITE;
/*!40000 ALTER TABLE `TypeCategorie` DISABLE KEYS */;
INSERT INTO `TypeCategorie` VALUES ('A1','Adulte','A'),('A2','Junior 8 à 18 ans','A'),('A3','Enfant 0 à 7 ans','A'),('B1','Voiture long.inf.4m','B'),('B2','Voiture long.inf.5m','B'),('C1','Fourgon','C'),('C2','Camping Car','C'),('C3','Camion','C');
/*!40000 ALTER TABLE `TypeCategorie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reserver`
--

DROP TABLE IF EXISTS `reserver`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reserver` (
  `nbPlace` int(11) DEFAULT NULL,
  `codeTypeCategorie` varchar(2) NOT NULL,
  `numeroReservation` bigint(20) NOT NULL,
  PRIMARY KEY (`codeTypeCategorie`,`numeroReservation`),
  KEY `reserver_ibfk_2` (`numeroReservation`),
  CONSTRAINT `reserver_ibfk_1` FOREIGN KEY (`codeTypeCategorie`) REFERENCES `TypeCategorie` (`codeTypeCategorie`),
  CONSTRAINT `reserver_ibfk_2` FOREIGN KEY (`numeroReservation`) REFERENCES `Reservation` (`numeroReservation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reserver`
--

LOCK TABLES `reserver` WRITE;
/*!40000 ALTER TABLE `reserver` DISABLE KEYS */;
INSERT INTO `reserver` VALUES (2,'A1',9181458911),(2,'A1',9181458912),(1,'A2',9181458911),(1,'A2',9181458912),(2,'A3',9181458911),(1,'A3',9181458912),(1,'B2',9181458911),(1,'C1',9181458912);
/*!40000 ALTER TABLE `reserver` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-10-22 16:43:55
