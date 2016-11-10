CREATE DATABASE  IF NOT EXISTS `webindex` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `webindex`;
-- MySQL dump 10.13  Distrib 5.5.16, for Win32 (x86)
--
-- Host: localhost    Database: webindex
-- ------------------------------------------------------
-- Server version	5.5.16

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `categoryID` int(11) NOT NULL,
  `categoryTitle` varchar(45) NOT NULL,
  PRIMARY KEY (`categoryID`),
  UNIQUE KEY `categoryTitle_UNIQUE` (`categoryTitle`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (6,'Fast Food'),(2,'Fournos'),(3,'Kafe-Bar'),(4,'Oikos anoxis'),(1,'Super Market'),(5,'Vivliopwleio');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `image`
--

DROP TABLE IF EXISTS `image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `image` (
  `path` varchar(45) NOT NULL,
  `title` varchar(45) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `businessTitle` varchar(30) NOT NULL,
  PRIMARY KEY (`path`),
  KEY `fk_image_business1` (`businessTitle`),
  CONSTRAINT `fk_image_business1` FOREIGN KEY (`businessTitle`) REFERENCES `business` (`businessTitle`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `image`
--

LOCK TABLES `image` WRITE;
/*!40000 ALTER TABLE `image` DISABLE KEYS */;
/*!40000 ALTER TABLE `image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `username` varchar(8) NOT NULL,
  `passwordHash` varchar(100) NOT NULL,
  `email` varchar(45) NOT NULL,
  `salt` int(11) NOT NULL,
  `authenticated` tinyint(1) NOT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('anemonas','34vUn6hzYmD..','info@anemos.gr',34889,1),('arceroni','10m5Qxn.Kc1Gs','info@arco.gr',10480,1),('carref','60FPPAJDMwlh2','info@carrefour.fr',60839,1),('coopers','398FoznXd3s2M','info@cooplar.gr',39871,1),('galaxys','22zzEAKc8UPoI','info@galaxysm.gr',22837,1),('gourgi','60lRU9WDIXeWo','info@gourgiwtis.gr',60317,1),('grammis','94NPwpLomfyzo','info@grammi.gr',94836,1),('larisasm','53IgPfjJlA7bs','info@supermarketlarisa.gr',53195,1),('lazaros','218btMoZOSFU.','info@gp.gr',21640,1),('mikelas','63RmadInJth12','info@mikel.gr',63953,1),('mindk','896BoiY0qH17s','ramenoskata@gmail.com',89738,1),('ntistoni','20M61ZBq7Jqsw','info@ntistasbakery.gr',20560,1),('paideras','94mSIwCxn.vMU','info@paideia.gr',94932,1),('papoutsa','70hzP/zm89VoI','info@papoutsas.gr',70927,1),('seforas','932PT8Q3bNivs','info@sef.gr',93902,1),('sfairas','541Iplxb7U48k','info@sfaira.gr',54826,1),('simoul','16Rw1soIAJU4g','info@simoulis.gr',16001,1),('skuftron','22cuiYanhoikM','info@skyftas.gr',22884,1),('soulara','354sTBKl8unTc','info@fscksoula.gr',35502,1),('tonoteat','21mLDb7lesbss','info@toeat.eu',21211,1),('trigwnos','26YpwJttZpT7A','info@trigwnaki.gr',26163,1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `business`
--

DROP TABLE IF EXISTS `business`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `business` (
  `businessTitle` varchar(30) NOT NULL,
  `address` varchar(45) DEFAULT NULL,
  `postalCode` varchar(5) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `keywords` varchar(100) DEFAULT NULL,
  `site` varchar(45) DEFAULT NULL,
  `username` varchar(8) NOT NULL,
  `categoryID` int(11) NOT NULL,
  PRIMARY KEY (`businessTitle`),
  KEY `fk_business_user` (`username`),
  KEY `fk_business_category1` (`categoryID`),
  CONSTRAINT `fk_business_category1` FOREIGN KEY (`categoryID`) REFERENCES `category` (`categoryID`) ON UPDATE CASCADE,
  CONSTRAINT `fk_business_user` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `business`
--

LOCK TABLES `business` WRITE;
/*!40000 ALTER TABLE `business` DISABLE KEYS */;
INSERT INTO `business` VALUES ('Anemos','Kuprou 47','41222','2410252390','anemws,kyprou,kyproy,vivliopwleio,vivliopolio,vivlia,tetradio,xartika,fwtotupia,fototipia','http://www.anemos.gr','anemonas',5),('Arco','Papakuriazi 23','41229','2410664531','arko,street cafe,kafes,kafeteria,mpura,taxudromiou,paralia larisas,strimoksidi,vavoura,trendy,diva','http://www.arco.gr','arceroni',3),('Carrefour','Kozanis 56','41501','2410634789','carefour,carfour,carrefour super market,souper market,kozanhs','http://www.carrefour.fr','carref',1),('Chef','Rousvelt 25','41222','2410250050','skoupidia,guros 700kg,giros,rouzvelt,chef,fagito,souvlaki,fastfood,kotopoulo,pita,fagadiko,delivery','http://www.sef.gr','seforas',6),('Coop','Kuprou 10','41200','2410695324','cup,koup,kup,coop super market,souper market,kyprou','http://www.cooplar.gr','coopers',1),('Galaxias','Nea Smirni 12','43342','2410730564','galaksias,galaxy,galaxy s plus,gs ,galaxias super market,souper market,nea smurni,nea smurnh','http://www.galaxysm.gr','galaxys',1),('Gourgiwtis','Magrie 7','41336','2410617007','gourgiotis,gourgioths,gurgiotis,gurgiwtis,fournos,foyrnos,fournws,foyrnws,pswmi,psomi,artos','http://www.gourgiwts.gr','gourgi',2),('Grammi','Nirvana 7','41221','2410531638','grami,grammh,vivliopwleio,vivliopolio,vivlia,xartika,nhrvana,tetradia,fwtotupies,grafikh ulh','http://www.grammi.gr','grammis',5),('Green Park','Kozanis 36','41500','2410591297','kozanis,gkrin,grin,kozanhs,kafes,kafe,kafeteria,bar,mpura,mpira,poto,xumos,ximos,sokolata','http://www.gp.gr','lazaros',3),('Larisa','Ypsilantou 19','41789','2410668904','lar,larsa,larissa,super market larisa,souper market,ipsilantou,upshlantou','http://www.supermarketlarisa.gr','larisasm',1),('Mikel','Kuprou 25','41220','2410934875','kafeteria,kafes,kafe,xamos,thiela,panta gemato,polla lefta,trendy,moda,oloi ekei,dives,leftades','http://www.mikel.gr','mikelas',3),('MK ULTRA','loopback','41666','0903295620','nwo,mdk,mind control','http://antinwo.com','mindk',4),('MKUL','','','','','http://','mindk',3),('Ntistas','Karditsis 23','41671','2410282769','ntustas,ntystas,fournos,foyrnos,artos,mpagiatiko,pswmi,psomi,psomy,psomu,ywmi,yomi,karditshs','http://www.ntistasbakery.gr','ntistoni',2),('Oikos Epoxhs Soula','Komvos Sukouriou','43600','2410090369','erwtas,sex,stomatiko,69,mpourdelo,villa,gunaikes,doggy,fuck,piswkollito,tsimpouki,epoxi,ikos,anoxi','http://www.fscksoula.gr','soulara',4),('Paideia','Kanari 12','41223','2410239038','paidia,pedeia,vivliopwleio,vivliopolio,vivlia,xartika,kanarh,tetradio,logotexnia,diavasma,suggrama','http://www.paideia.gr','paideras',5),('Papoutsas','Papanastasiou Alexandrou 68','41222','2410254040','papanastasioy,vivliopwleio,vivliopolio,vivlia,tetradio,xartika,fwtotupia,fototipia','http://www.papoutsas.gr','papoutsa',5),('Sfaira','Tagmatarxou Velissariou 41','41222','2410531738','velisariou,velissarioy,vivliopwleio,vivliopolio,sfera,xartika,fototipia,grafiki ili,suggrama','http://www.sfaira.gr','sfairas',5),('Simoulis','Volou 18','41223','2410284127','shmoulhs,sumoulis,pswmi,psomi,fournos,foyrnos,fournws,zumwto,zumoto,zimoto,artos,voloy,vwlou','http://www.simoulis.gr','simoul',2),('Skuftas','Thumatwn Katoxis 69','41335','2410625961','skiftas,skyftas,foyrnos,fournos,fournws,foyrnws,thymatwn katoxis,katwxhs,psomi,pswmi,artos','http://www.skyftas.gr','skuftron',2),('To eat','Asklipiou 27','41223','2410537353','asklhpiou,toeat,giros,guros,fastfood,delivery,souvlaki,ola stegna,kotopoulo,vrwmiko,giradiko','http://www.toeat.eu','tonoteat',6),('Trigwno Geusewn','Rousvelt 45','41222','2410630215','trigono,giros,guros,fastfood,souvlaki,pita,fagadiko,delivery,rouzvelt,kontosouvli,giradiko','http://www.trigwnaki.gr','trigwnos',6),('Villa Erotica','Psipsinouli 4','44511','2410090639','villa,erwtas,sex,69,mpourdelo,gunaikes,doggy,fuck,piswkollito,tsimpouki,ikos,anoxi,ksalafrwma','http://www.villaerotica.gr','soulara',4);
/*!40000 ALTER TABLE `business` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-06-19  6:21:01
