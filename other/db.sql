-- Database: blog
-- Table structure for table `users`
-- Table structure for table `posts`
-- NeverLAN CTF <info@neverlanctf.com>
-- Author : Zane Durkin

-- Create user for web
CREATE USER 'blog'@'localhost' IDENTIFIED BY '<password_web>';
CREATE USER 'blog'@'%' IDENTIFIED BY '<password_web>';
GRANT SELECT ON blog.* To 'blog'@'localhost' WITH GRANT OPTION;
GRANT UPDATE ON blog.* To 'blog'@'localhost' WITH GRANT OPTION;
GRANT UPDATE ON blog.* To 'blog'@'%' WITH GRANT OPTION;
GRANT SELECT ON blog.* To 'blog'@'%' WITH GRANT OPTION;


-- Add password for root user
/*--ALTER USER 'root'@'localhost' IDENTIFIED BY '<password_root>';*/

-- Create sql_fun1 database
CREATE DATABASE `blog`;
USE `blog`;

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `permissions` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

LOCK TABLES `posts` WRITE;
INSERT INTO `posts` VALUES (1,'The key, password resets are hard','<p>I know this post is only available for admins, and since I am the only admin on the blog, I decided to start keeping my passwords on here for quick access.<br>Everyone says that it isin\'t a good idea, but I don\'t care, nobody reads this blog anyway...<br> <ul><li><p>CTF KEY: Long_password_dont_help_with_faulty_reset</p></li><li><p>Word: ssh</p></li></ul>','ADMIN'),(2,'The First Entry','<p> This is my first time writing a blog for my very own, custom made, website!!!!</p><p>I even made my own password reset and login pages. Not to mention that I can set posts to only show for users with special permissions!</p>','OPEN'),(3,'Yet another log entry that you probably won\'t read','<p>so... it turns out not a whole lot of people actually visit my blog... maybe I should host it on a public server.</p>','OPEN');
UNLOCK TABLES;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `permissions` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `sq1` varchar(255) DEFAULT NULL,
  `sa1` varchar(255) DEFAULT NULL,
  `sq2` varchar(255) DEFAULT NULL,
  `sa2` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

LOCK TABLES `users` WRITE;
INSERT INTO `users` VALUES (1,'admin','ADMIN','ALongPasswordThatNoOneWillGuess1029384756','What is the answer to the first question?','asfdasdfasdfasdfasdf','What is the anwser to the second question?','asdfasdfasdf');
UNLOCK TABLES;
