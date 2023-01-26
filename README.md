# portalove-riesenia-ext-2022

Demo stranka projektu pre portalove riesenia 2022 (externisti).

## Instalacia

* Spustit skript db_init.sql na vytvorenie databazy na databazovom servery
```
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
```
* Nasmerovat apache pripadne iny webovy server aby sa odkazoval na index.php v tomto projekte
