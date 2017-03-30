DROP DATABASE if EXISTS oci_eLab;
CREATE DATABASE oci_eLab;
USE oci_eLab;

CREATE TABLE Users (
  userId             int(11) NOT NULL AUTO_INCREMENT UNIQUE,
  facebookId		 varchar (255) UNIQUE COLLATE utf8_unicode_ci,
  userName           varchar (255) UNIQUE NOT NULL COLLATE utf8_unicode_ci,
  passwordHash           varchar(255) COLLATE utf8_unicode_ci,
  dateCreated    	 TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (userId)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE UserData (
  userId             int(11) NOT NULL COLLATE utf8_unicode_ci UNIQUE,
  email           	 varchar(255) COLLATE utf8_unicode_ci,
  vmPassword         varchar(255) COLLATE utf8_unicode_ci,
  messengerId        varchar(255) COLLATE utf8_unicode_ci,
  FOREIGN KEY (userId) REFERENCES Users(userId)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE Registration (
  userId             int(11) NOT NULL COLLATE utf8_unicode_ci UNIQUE,
  complete			 boolean DEFAULT false,
  FOREIGN KEY (userId) REFERENCES Users(userId)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;