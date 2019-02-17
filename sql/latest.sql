-- MySQL dump 10.16  Distrib 10.1.29-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: profiling_system
-- ------------------------------------------------------
-- Server version	10.1.29-MariaDB

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
-- Table structure for table `boilerplate`
--

DROP TABLE IF EXISTS `boilerplate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `boilerplate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `boilerplate`
--

LOCK TABLES `boilerplate` WRITE;
/*!40000 ALTER TABLE `boilerplate` DISABLE KEYS */;
/*!40000 ALTER TABLE `boilerplate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `class`
--

DROP TABLE IF EXISTS `class`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `year` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `section` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `semister` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `class`
--

LOCK TABLES `class` WRITE;
/*!40000 ALTER TABLE `class` DISABLE KEYS */;
/*!40000 ALTER TABLE `class` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `class_list`
--

DROP TABLE IF EXISTS `class_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `class_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `position` int(11) NOT NULL,
  `classroom` int(11) NOT NULL,
  `student` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `class_ref` (`classroom`),
  CONSTRAINT `class_ref` FOREIGN KEY (`classroom`) REFERENCES `classroom` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `class_list`
--

LOCK TABLES `class_list` WRITE;
/*!40000 ALTER TABLE `class_list` DISABLE KEYS */;
INSERT INTO `class_list` VALUES (11,'2018-02-16 17:53:20','',0,1,22),(12,'2018-02-16 18:45:12','',0,2,21),(13,'2018-02-23 14:46:50','',0,1,5),(15,'2018-02-18 03:17:38','',0,1,23),(16,'2018-02-18 03:30:12','',0,1,26),(17,'2018-02-18 03:40:59','',0,1,27);
/*!40000 ALTER TABLE `class_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `classroom`
--

DROP TABLE IF EXISTS `classroom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `classroom` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `department` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `level` int(11) NOT NULL,
  `section` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `class_dept_ref` (`department`),
  CONSTRAINT `class_dept_ref` FOREIGN KEY (`department`) REFERENCES `department` (`code`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `classroom`
--

LOCK TABLES `classroom` WRITE;
/*!40000 ALTER TABLE `classroom` DISABLE KEYS */;
INSERT INTO `classroom` VALUES (1,'2018-02-15 16:46:52','test','bsis',1,'A',2011,0),(2,'2018-02-15 17:30:28','','bsis',2,'B',2012,0),(3,'2018-02-16 15:59:24','','bsis',3,'A',2013,0),(4,'2018-02-16 15:59:57','','bsis',4,'A',2014,0);
/*!40000 ALTER TABLE `classroom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `dept_code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `department`
--

LOCK TABLES `department` WRITE;
/*!40000 ALTER TABLE `department` DISABLE KEYS */;
INSERT INTO `department` VALUES (1,'2018-01-03 22:07:27','BSIS','bsis',0),(2,'2018-01-03 22:08:18','TED','ted',0),(6,'2018-01-03 22:29:28','BSIT','bsit',0),(7,'2018-01-03 22:29:46','BSOA','bsoa',0),(8,'2018-02-02 17:15:37','Admin','admin',0),(9,'2018-02-18 02:08:53','ACT','ACT',0);
/*!40000 ALTER TABLE `department` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grades`
--

DROP TABLE IF EXISTS `grades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `semister` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `student` int(11) NOT NULL,
  `teacher_load` int(11) NOT NULL,
  `mid_term` float NOT NULL,
  `final_term` float NOT NULL,
  `final_grade` float NOT NULL,
  `remark` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grades`
--

LOCK TABLES `grades` WRITE;
/*!40000 ALTER TABLE `grades` DISABLE KEYS */;
INSERT INTO `grades` VALUES (10,'2018-02-18 01:39:06','',0,'second_sem',22,9,85,87,86,'Passed'),(11,'2018-02-18 01:39:01','',0,'first_sem',22,9,90,95,93,'Passed'),(12,'2018-02-18 01:38:43','',0,'first_sem',5,9,98,96,96,'Passed'),(13,'2018-02-18 01:38:56','',0,'first_sem',5,11,88,89,88,'Passed'),(14,'2018-02-18 01:39:18','',0,'second_sem',22,11,86,90,98,'Passed'),(17,'2018-02-18 01:38:49','',0,'second_sem',5,9,87,90,90,'Passed'),(18,'2018-02-18 03:02:54','',0,'first_sem',5,13,86,86,90,'PASS'),(19,'2018-02-18 03:03:38','',0,'first_sem',5,12,90,90,90,'PASS'),(20,'2018-02-18 03:08:50','',0,'first_sem',22,12,85,87,89,'PASS'),(21,'2018-02-18 03:09:34','',0,'second_sem',5,11,85,87,89,'PASS'),(22,'2018-02-18 03:11:06','',0,'second_sem',5,13,87,84,85,'PASS'),(23,'2018-02-18 03:11:38','',0,'second_sem',22,13,85,87,89,'PASS');
/*!40000 ALTER TABLE `grades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `message` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link` text COLLATE utf8_unicode_ci NOT NULL,
  `users` text COLLATE utf8_unicode_ci NOT NULL,
  `roles` text COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `unread` int(11) NOT NULL DEFAULT '1',
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES (5,'2018-02-16 01:30:09','New Teacher has been addddded','fa-slideshare','/users/teacher','','a:1:{i:0;s:4:\"_all\";}','blue',0,0),(7,'2018-02-16 08:58:09','Grades were updated','fa-area-chart','/grades','','a:1:{i:0;s:4:\"_all\";}','aqua',0,0),(8,'2018-02-15 17:33:37','New Teacher has been added','fa-slideshare','/subjects','','a:1:{i:0;s:4:\"_all\";}','blue',1,0),(9,'2018-02-16 01:26:18','Subject schedule was updated','fa-book','/subjects','','a:1:{i:0;s:4:\"_all\";}','yellow',0,0),(10,'2018-02-16 01:07:45','Grades were updated','fa-area-chart','/grades','','a:1:{i:0;s:4:\"_all\";}','aqua',0,0),(11,'2018-02-16 01:32:26','New classroom has been added','fa-cube','/classroom','','a:1:{i:0;s:4:\"_all\";}','yellow',1,0),(12,'2018-02-16 01:32:23','Classroom has been updated','fa-cube','/classroom','','a:1:{i:0;s:4:\"_all\";}','yellow',1,0),(13,'2018-02-16 01:07:53','A subject has been updated','fa-book','/subjects','','a:1:{i:0;s:4:\"_all\";}','yellow',0,0),(14,'2018-02-16 01:07:28','New subject has been added','fa-book','/subjects','','a:1:{i:0;s:4:\"_all\";}','yellow',0,0),(15,'2018-02-16 01:34:32','A classroom has been updated','fa-cube','/classroom','','a:1:{i:0;s:4:\"_all\";}','yellow',1,0),(16,'2018-02-16 08:57:47','A classroom has been updated','fa-cube','/classroom','','a:1:{i:0;s:4:\"_all\";}','yellow',0,0),(17,'2018-02-16 15:57:55','A classroom has been updated','fa-cube','/classroom','','a:1:{i:0;s:4:\"_all\";}','yellow',1,0),(18,'2018-02-16 15:58:53','A classroom has been updated','fa-cube','/classroom','','a:1:{i:0;s:4:\"_all\";}','yellow',1,0),(19,'2018-02-16 15:59:24','New classroom has been added','fa-cube','/classroom','','a:1:{i:0;s:4:\"_all\";}','yellow',1,0),(20,'2018-02-16 15:59:58','New classroom has been added','fa-cube','/classroom','','a:1:{i:0;s:4:\"_all\";}','yellow',1,0),(21,'2018-02-16 16:01:03','A classroom has been updated','fa-cube','/classroom','','a:1:{i:0;s:4:\"_all\";}','yellow',1,0),(22,'2018-02-16 16:03:00','A subject has been updated','fa-book','/subjects','','a:1:{i:0;s:4:\"_all\";}','yellow',1,0),(23,'2018-02-16 16:03:49','New subject has been added','fa-book','/subjects','','a:1:{i:0;s:4:\"_all\";}','yellow',1,0),(24,'2018-02-17 23:03:49','A classroom has been updated','fa-cube','/classroom','','a:1:{i:0;s:4:\"_all\";}','yellow',1,0),(25,'2018-02-18 02:07:52','New subject has been added','fa-book','/subjects','','a:1:{i:0;s:4:\"_all\";}','yellow',1,0),(26,'2018-02-18 02:10:46','A subject has been updated','fa-book','/subjects','','a:1:{i:0;s:4:\"_all\";}','yellow',1,0),(27,'2018-02-18 02:11:48','A subject has been updated','fa-book','/subjects','','a:1:{i:0;s:4:\"_all\";}','yellow',1,0),(28,'2018-02-18 02:16:11','A subject has been updated','fa-book','/subjects','','a:1:{i:0;s:4:\"_all\";}','yellow',1,0),(29,'2018-02-18 02:17:40','A subject has been updated','fa-book','/subjects','','a:1:{i:0;s:4:\"_all\";}','yellow',1,0),(30,'2018-02-18 02:19:53','A subject has been updated','fa-book','/subjects','','a:1:{i:0;s:4:\"_all\";}','yellow',1,0),(31,'2018-02-18 02:20:55','New subject has been added','fa-book','/subjects','','a:1:{i:0;s:4:\"_all\";}','yellow',1,0),(32,'2018-02-18 02:21:11','A subject has been updated','fa-book','/subjects','','a:1:{i:0;s:4:\"_all\";}','yellow',1,0),(33,'2018-02-18 02:21:53','New subject has been added','fa-book','/subjects','','a:1:{i:0;s:4:\"_all\";}','yellow',1,0),(34,'2018-02-18 02:23:11','New subject has been added','fa-book','/subjects','','a:1:{i:0;s:4:\"_all\";}','yellow',1,0),(35,'2018-02-18 02:24:41','New subject has been added','fa-book','/subjects','','a:1:{i:0;s:4:\"_all\";}','yellow',1,0),(36,'2018-02-18 02:43:04','A subject has been updated','fa-book','/subjects','','a:1:{i:0;s:4:\"_all\";}','yellow',1,0),(37,'2018-02-18 02:43:25','A subject has been updated','fa-book','/subjects','','a:1:{i:0;s:4:\"_all\";}','yellow',1,0),(38,'2018-02-18 02:43:39','A subject has been updated','fa-book','/subjects','','a:1:{i:0;s:4:\"_all\";}','yellow',1,0),(39,'2018-02-18 02:43:54','A subject has been updated','fa-book','/subjects','','a:1:{i:0;s:4:\"_all\";}','yellow',1,0),(40,'2018-02-18 02:44:19','A subject has been updated','fa-book','/subjects','','a:1:{i:0;s:4:\"_all\";}','yellow',1,0),(41,'2018-02-18 02:44:33','A subject has been updated','fa-book','/subjects','','a:1:{i:0;s:4:\"_all\";}','yellow',1,0),(42,'2018-02-18 02:44:50','A subject has been updated','fa-book','/subjects','','a:1:{i:0;s:4:\"_all\";}','yellow',1,0),(43,'2018-02-18 02:45:03','A subject has been updated','fa-book','/subjects','','a:1:{i:0;s:4:\"_all\";}','yellow',1,0),(44,'2018-02-18 02:45:18','A subject has been updated','fa-book','/subjects','','a:1:{i:0;s:4:\"_all\";}','yellow',1,0),(45,'2018-02-18 02:45:32','A subject has been updated','fa-book','/subjects','','a:1:{i:0;s:4:\"_all\";}','yellow',1,0),(46,'2018-02-18 03:30:18','A classroom has been updated','fa-cube','/classroom','','a:1:{i:0;s:4:\"_all\";}','yellow',1,0);
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schedule`
--

DROP TABLE IF EXISTS `schedule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `schedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `class` int(11) NOT NULL,
  `department` int(11) NOT NULL,
  `subject` int(11) NOT NULL,
  `assigned_teacher` int(11) NOT NULL,
  `days` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schedule`
--

LOCK TABLES `schedule` WRITE;
/*!40000 ALTER TABLE `schedule` DISABLE KEYS */;
/*!40000 ALTER TABLE `schedule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_information`
--

DROP TABLE IF EXISTS `student_information`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student_information` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `position` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `age` int(11) NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `middle_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `birth_place` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `present_address` text COLLATE utf8_unicode_ci NOT NULL,
  `religion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `height` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `landline` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cellphone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `p_first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `p_last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `p_middle_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `p_cellphone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `elementary` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `grad_elementary` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `secondary` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `grad_secondary` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tertiary` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `grad_tertiary` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `p_present_address` text COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `civil_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `student_info_ref` (`user_id`),
  CONSTRAINT `student_info_ref` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_information`
--

LOCK TABLES `student_information` WRITE;
/*!40000 ALTER TABLE `student_information` DISABLE KEYS */;
INSERT INTO `student_information` VALUES (9,'2018-02-25 23:21:48','Joy',0,5,18,'Joy','Acaya','','1994-01-01','','','','','','','','','','','','','','','','','','test info','female','single');
/*!40000 ALTER TABLE `student_information` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subjects`
--

DROP TABLE IF EXISTS `subjects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `department` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `units` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subjects`
--

LOCK TABLES `subjects` WRITE;
/*!40000 ALTER TABLE `subjects` DISABLE KEYS */;
INSERT INTO `subjects` VALUES (1,'2018-02-15 14:37:30','Web Server Administration','WDPD442','bsis',3),(2,'2018-02-15 15:11:02','Interprise Resource Planning','FSTUDY431','bsis',3),(3,'2018-02-15 17:43:11','Intro to Information System Profession and Ethics','PETHICS431','bsis',3),(4,'2018-02-16 16:03:49','Lan Installation and Maintenance','ELECT431','bsis',3),(5,'2018-02-18 02:07:52','Philippine Government and Constitution','PHILGOV430','bsis',3),(6,'2018-02-18 02:20:55','General Psychology','GENPSYC430','bsis',3),(7,'2018-02-18 02:21:52','Financial Management','BUSM431','bsis',3),(8,'2018-02-18 02:23:11','Humanities-Art Appreciation','HUMA 430','bsis',3),(9,'2018-02-18 02:24:41','Capstone 2','CAPS 2','bsis',3);
/*!40000 ALTER TABLE `subjects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teacher_load`
--

DROP TABLE IF EXISTS `teacher_load`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teacher_load` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subject` int(11) NOT NULL,
  `day` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  `classroom` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `subject_ref` (`subject`),
  KEY `teacher_load_id_ref` (`teacher_id`),
  CONSTRAINT `teacher_load_id_ref` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teacher_load`
--

LOCK TABLES `teacher_load` WRITE;
/*!40000 ALTER TABLE `teacher_load` DISABLE KEYS */;
INSERT INTO `teacher_load` VALUES (3,'2018-02-15 18:24:24','asdfasdf 1111',3,'sun','12:00:00','12:30:00',2,8,0),(7,'2018-02-16 04:00:15','',3,'sat','10:00:00','10:00:00',2,18,0),(8,'2018-02-16 08:38:54','',2,'mon','07:00:00','07:00:00',1,18,0),(9,'2018-02-16 15:13:28','',1,'mon','07:00:00','07:00:00',1,4,0),(11,'2018-02-17 23:02:43','',4,'mon','07:00:00','10:00:00',1,4,0),(12,'2018-02-18 02:54:12','',7,'mon','07:00:00','08:30:00',1,4,0),(13,'2018-02-18 02:54:26','',2,'mon','07:00:00','07:00:00',1,4,0);
/*!40000 ALTER TABLE `teacher_load` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_roles`
--

DROP TABLE IF EXISTS `user_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `role_code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_roles`
--

LOCK TABLES `user_roles` WRITE;
/*!40000 ALTER TABLE `user_roles` DISABLE KEYS */;
INSERT INTO `user_roles` VALUES (1,'2018-01-06 21:40:53','Admin','admin',3),(2,'2018-01-02 04:11:25','Student','student',0),(3,'2018-01-06 21:41:13','Dept. Coordinator','dept_coordinator',2),(4,'2018-01-06 21:41:06','Teacher','teacher',1),(5,'2018-02-02 17:05:51','Registrar','registrar',0);
/*!40000 ALTER TABLE `user_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `department` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `middle_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `passcode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `record_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Student ID provided by registrar',
  PRIMARY KEY (`id`),
  KEY `role_ref` (`role`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'2018-01-06 21:06:32','John','bsis','Doe','','dept_coordinator','demo_dept_coordinator','','hxs78rwa',''),(4,'2018-01-06 21:07:32','Jane','bsis','Doe','','teacher','demo_teacher','','azksxl2b',''),(5,'2018-02-23 16:24:36','Joy','bsis','Acaya','','student','demo_student','','v1eu4rl1','BS-0019'),(7,'2018-01-06 23:28:10','John','bsis','Evans','','dept_coordinator','user_2ahy68lt','','xnpizrkh',''),(8,'2018-01-06 23:32:02','Will','bsit','Turner','','teacher','user_m3k4nief','','1y1tx7zm',''),(9,'2018-01-07 00:40:47','Felix','ted','Monroe','','dept_coordinator','user_rv7pb2wp','','unuvgsjn',''),(10,'2018-01-07 00:45:55','Henry','bsis','Go','','student','user_5lqsqfus','','demo123','BS-0038'),(11,'2018-01-07 00:47:05','Sarah','ted','Oliveros','','student','user_n66huevs','','fmjgq01e',''),(12,'2018-01-07 00:47:56','Leslie','bsoa','Brinn','','dept_coordinator','user_r9udwaiz','','3h8f4dtj',''),(13,'2018-01-07 00:48:23','Alexandra','bsoa','Hope','','teacher','user_ip6544sv','','qyx14jw7',''),(14,'2018-01-07 00:49:00','Liza','ted','Mayers','','teacher','user_kqrck578','','8cd4sxd2',''),(15,'2018-01-08 06:47:44','Mark','bsis','Allen','','teacher','Mark','','w27b0suf',''),(16,'2018-02-02 17:15:00','Emma','','Wayne','Del Mundo','registrar','demo_registrar','','vuqb2q2h',''),(17,'2018-02-02 18:26:17','Davey','bsit','Jones','','student','user_v5yg8nlc','','wxzktsv2','BS-0099'),(18,'2018-02-16 03:54:44','Emma','bsit','Stone','','teacher','user_vf5f6sov','','b319a91e',''),(19,'2018-02-16 04:07:38','Eric','bsit','Sins','','teacher','user_6fl5ol0p','','s0k713ry',''),(20,'2018-02-16 06:04:28','Liza','bsit','Smith','','student','user_xs8902s6','','h1vlyuui',''),(22,'2018-02-16 17:05:20','Kenny','bsis','Alegre','','student','user_74e90eo8','','v8dh5nq8','BS-0023'),(23,'2018-02-18 01:35:59','Rhia','bsis','Alvarez','','student','user_bzouvbrb','','f606h6nv','BS-0053'),(25,'2018-02-18 02:56:10','Norberto','bsis','Mondero','','teacher','Norberto','','klzaqqo6',''),(26,'2018-02-18 03:29:39','Joy','bsis','Ilagan','','student','user_fazv0vhr','','yyab4s8e',''),(27,'2018-02-18 03:40:03','Jeth','bsis','Reyes','','student','Jeth','','wbvu8wcc','BS-0088');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-02-14 23:13:40
