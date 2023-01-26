/*!40000 DROP DATABASE IF EXISTS `portalove-riesenia`*/;

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `portalove-riesenia` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `portalove-riesenia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `komentare` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nick` varchar(100) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
