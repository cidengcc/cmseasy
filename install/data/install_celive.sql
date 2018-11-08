-- phpMyAdmin SQL Dump
-- version 2.6.1-rc1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Oct 02, 2009 at 12:39 PM
-- Server version: 4.0.20
-- PHP Version: 4.3.11
-- 
-- Database: `celive`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `activity`
-- 

DROP TABLE IF EXISTS `cmseasy_activity`;
CREATE TABLE `cmseasy_activity` (
  `id` int(255) NOT NULL auto_increment,
  `timestamp` int(255) default NULL,
  `operatorid` varchar(255) NOT NULL default '',
  `departmentid` int(10) NOT NULL default '0',
  `status` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

-- 
-- Table structure for table `assigns`
-- 

DROP TABLE IF EXISTS `cmseasy_assigns`;
CREATE TABLE `cmseasy_assigns` (
  `id` int(255) NOT NULL auto_increment,
  `departmentid` int(255) NOT NULL default '0',
  `operatorid` int(255) NOT NULL default '0',
  `poll` int(255) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------


-- 
-- Table structure for table `chat`
-- 

DROP TABLE IF EXISTS `cmseasy_chat`;
CREATE TABLE `cmseasy_chat` (
  `id` int(255) unsigned NOT NULL auto_increment,
  `sessionid` int(10) NOT NULL default '0',
  `name` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `message` varchar(200) default NULL,
  `timestamp` int(10) NOT NULL default '0',
  `ip` varchar(20) NOT NULL,
  `departmentid` int(10) default NULL,
  `operatorid` int(10) default NULL,
  `status` tinyint(1) NOT NULL default '0',
  `admin_status` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

-- 
-- Table structure for table `departments`
-- 

DROP TABLE IF EXISTS `cmseasy_departments`;
CREATE TABLE `cmseasy_departments` (
  `id` int(255) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `visible` int(1) NOT NULL default '1',
  `order` int(255) NOT NULL default '1',
  `email` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------


-- 
-- Table structure for table `operators`
-- 

DROP TABLE IF EXISTS `cmseasy_operators`;
CREATE TABLE `cmseasy_operators` (
  `id` int(255) NOT NULL auto_increment,
  `username` varchar(255) NOT NULL default '',
  `password` varchar(255) NOT NULL default '',
  `firstname` varchar(255) NOT NULL default '',
  `lastname` varchar(255) NOT NULL default '',
  `email` varchar(255) NOT NULL default '',
  `departmentid` int(10) NOT NULL default '0',
  `level` int(1) NOT NULL default '0',
  `timestamp` int(255) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------


-- 
-- Table structure for table `sessions`
-- 

DROP TABLE IF EXISTS `cmseasy_sessions`;
CREATE TABLE `cmseasy_sessions` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `departmentid` int(10) NOT NULL default '0',
  `timestamp` int(10) NOT NULL default '0',
  `ip` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

-- 
-- Table structure for table `detail`
-- 

DROP TABLE IF EXISTS `cmseasy_detail`;
CREATE TABLE `cmseasy_detail` (
  `id` int(255) NOT NULL auto_increment,
  `chatid` int(255) NOT NULL default '0',
  `detail` text NOT NULL,
  `who_witter` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `cmseasy_operators` (`username`, `password`, `firstname`, `lastname`, `email`, `level`) VALUES ('admin', '21232f297a57a5a743894a0e4a801fc3', "CmsEasyLive", "CElive", "admin@cmseasy.cn", "0");