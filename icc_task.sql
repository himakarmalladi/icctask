/*
SQLyog Community v13.1.6 (64 bit)
MySQL - 10.1.38-MariaDB : Database - icc_task
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`icc_task` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `icc_task`;

/*Table structure for table `result` */

DROP TABLE IF EXISTS `result`;

CREATE TABLE `result` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rollno` int(11) DEFAULT NULL,
  `subject` varchar(60) DEFAULT NULL,
  `total_mark` int(11) DEFAULT '100',
  `mark_obtain` int(11) DEFAULT NULL,
  `result` tinyint(1) DEFAULT NULL,
  `grade` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `result` */

insert  into `result`(`id`,`rollno`,`subject`,`total_mark`,`mark_obtain`,`result`,`grade`) values 
(2,1003,'Maths',100,80,1,'A+'),
(4,1004,'EDC',100,55,1,'C'),
(5,1005,'Maths 2',100,42,0,'F');

/*Table structure for table `student` */

DROP TABLE IF EXISTS `student`;

CREATE TABLE `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rollno` int(11) DEFAULT NULL,
  `name` varchar(60) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `dept` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `student` */

insert  into `student`(`id`,`rollno`,`name`,`email`,`mobile`,`dept`) values 
(1,1001,'Harish','harish@gmail.com','8585858585','CSE'),
(2,1002,'Madhu','madhu@gmail.com','9595959595','CSE'),
(3,1003,'Kalyan','kalyan@gmail.com','7575757575','ECE'),
(4,1004,'Rohan','rohan@gmail.com','6585658565','ECE'),
(5,1005,'Ramesh','ramesh@gmail.com','6585758574','EEE'),
(6,1006,'Ravi','ravi@gmail.com','7585968574','CIVIL'),
(7,1007,'Pavan','pavan@gmail.com','9595858575','CIVIL'),
(8,1008,'Lokesh','lokesh@gmail.com','7545757475','CSE');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
