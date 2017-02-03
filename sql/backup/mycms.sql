-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2017-02-03 03:01:06
-- 服务器版本： 5.7.11
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mycms`
--

-- --------------------------------------------------------

--
-- 表的结构 `sys_articles`
--

CREATE TABLE `sys_articles` (
  `Id` int(11) NOT NULL,
  `Position` int(5) DEFAULT '0',
  `ArticleTitle` varchar(40) NOT NULL,
  `ArticleCate` varchar(40) NOT NULL,
  `ArticleCateId` int(5) DEFAULT NULL,
  `ArticleCateName` varchar(40) DEFAULT NULL,
  `ArticleContent` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `sys_articles`
--

INSERT INTO `sys_articles` (`Id`, `Position`, `ArticleTitle`, `ArticleCate`, `ArticleCateId`, `ArticleCateName`, `ArticleContent`) VALUES
(1, 2, '11111', 'news', 2, '公司新闻', '11111'),
(2, 1, '2222', 'news', 2, '公司新闻', '2222'),
(3, 0, '333', 'news', 3, '行业新闻', '3333'),
(4, 0, 'aaaa', 'lastest', 5, '公司最新动态', 'aaaaaaaaaaaaa'),
(5, 0, 'bbbb', 'lastest', 5, '公司最新动态', 'bbbbbbbbbbbbbbbbbbbbb'),
(6, 0, 'cccc', 'lastest', 6, '行业最新动态', 'ccccccccccccccccc'),
(7, 0, 'dddd', 'lastest', 6, '行业最新动态', 'ddddddddddddddddd');

-- --------------------------------------------------------

--
-- 表的结构 `sys_articles_cate`
--

CREATE TABLE `sys_articles_cate` (
  `Id` int(5) NOT NULL,
  `Position` int(5) DEFAULT '0',
  `isChild` tinyint(1) DEFAULT '0',
  `ArticleTitle` varchar(100) NOT NULL,
  `ArticleCate` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `sys_articles_cate`
--

INSERT INTO `sys_articles_cate` (`Id`, `Position`, `isChild`, `ArticleTitle`, `ArticleCate`) VALUES
(1, 1, 0, '新闻资讯', 'news'),
(2, 1, 1, '公司新闻', 'news'),
(3, 2, 1, '行业新闻', 'news'),
(4, 2, 0, '最新动态', 'lastest'),
(5, 1, 1, '公司最新动态', 'lastest'),
(6, 2, 1, '行业最新动态', 'lastest');

-- --------------------------------------------------------

--
-- 表的结构 `sys_navigation`
--

CREATE TABLE `sys_navigation` (
  `Id` int(5) NOT NULL,
  `Title` varchar(20) NOT NULL,
  `Type` int(1) NOT NULL DEFAULT '1',
  `Link` varchar(20) NOT NULL,
  `Position` int(5) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `sys_navigation`
--

INSERT INTO `sys_navigation` (`Id`, `Title`, `Type`, `Link`, `Position`) VALUES
(94, '关于我们', 2, '/pages/about', 1),
(36, '首页', 1, '/', 0),
(103, '产品案例', 2, '/pages/case', 4),
(101, 'ss', 2, '/pages/ss', 2),
(102, '联系我们', 2, '/pages/contact', 3);

-- --------------------------------------------------------

--
-- 表的结构 `sys_pages`
--

CREATE TABLE `sys_pages` (
  `Id` int(5) NOT NULL,
  `Position` int(5) DEFAULT '0',
  `PageTitle` varchar(20) NOT NULL,
  `PageCate` varchar(20) NOT NULL,
  `PageContent` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `sys_pages`
--

INSERT INTO `sys_pages` (`Id`, `Position`, `PageTitle`, `PageCate`, `PageContent`) VALUES
(1, 1, '企业介绍2', 'about', '<p>企业介绍测试文本s</p>'),
(2, 2, '企业荣誉', 'about', '<p>企业荣誉测试文本</p>'),
(3, 1, '联系方式', 'contact', '<p>联系<span style="text-decoration: underline;">联系</span><em>方式</em><strong>方式</strong><sub>联系</sub><sup>方式</sup></p>'),
(22, 2, '行业产品', 'case', '<p>行业产品行业产品行业产品行业产品行业产品<br></p>'),
(21, 1, '公司产品', 'case', '<p>公司产品公司产品公司产品公司产品<br></p>'),
(9, 0, '111', 'contact', '<p>hi<br/></p>'),
(10, 0, '222', 'contact', '<p>222<br/></p>'),
(24, 0, 'sss1', 'ss', '<p>sss</p>'),
(26, 0, '1111', 'ss', '<p><img src="/uploads/image/20170203/1486090003574043.png" title="1486090003574043.png" alt="QQ图片20170112101628.png"/></p>');

-- --------------------------------------------------------

--
-- 表的结构 `sys_pages_cate`
--

CREATE TABLE `sys_pages_cate` (
  `Id` int(11) NOT NULL,
  `Position` int(5) DEFAULT '0',
  `PageCate` varchar(20) NOT NULL,
  `PageName` varchar(20) NOT NULL,
  `IsAdd` int(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `sys_pages_cate`
--

INSERT INTO `sys_pages_cate` (`Id`, `Position`, `PageCate`, `PageName`, `IsAdd`) VALUES
(1, 1, 'about', '关于我们', 1),
(2, 3, 'contact', '联系我们', 1),
(11, 2, 'case', '产品案例', 1),
(12, 4, 'ss', 'ss', 1);

-- --------------------------------------------------------

--
-- 表的结构 `sys_user`
--

CREATE TABLE `sys_user` (
  `Id` int(11) NOT NULL COMMENT 'id',
  `UserName` varchar(20) NOT NULL,
  `PassWord` varchar(40) NOT NULL,
  `UserType` varchar(10) NOT NULL,
  `RealName` varchar(20) DEFAULT NULL,
  `LastLoginIP` varchar(20) DEFAULT NULL,
  `LastLoginTime` int(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='管理员表';

--
-- 转存表中的数据 `sys_user`
--

INSERT INTO `sys_user` (`Id`, `UserName`, `PassWord`, `UserType`, `RealName`, `LastLoginIP`, `LastLoginTime`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'super', '管理员先生', '192.168.1.151', 1486090096),
(17, 'aaaa', '74b87337454200d4d33f80c4663dc5e5', 'normal', 'aaaa', '192.168.1.151', 1486090077),
(18, 'bbbb', '65ba841e01d6db7733e90a5b7f9e6f80', 'normal', 'b', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sys_articles`
--
ALTER TABLE `sys_articles`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `sys_articles_cate`
--
ALTER TABLE `sys_articles_cate`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `sys_navigation`
--
ALTER TABLE `sys_navigation`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Id` (`Id`);

--
-- Indexes for table `sys_pages`
--
ALTER TABLE `sys_pages`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `sys_pages_cate`
--
ALTER TABLE `sys_pages_cate`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `sys_user`
--
ALTER TABLE `sys_user`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `username` (`UserName`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `sys_articles`
--
ALTER TABLE `sys_articles`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- 使用表AUTO_INCREMENT `sys_articles_cate`
--
ALTER TABLE `sys_articles_cate`
  MODIFY `Id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- 使用表AUTO_INCREMENT `sys_navigation`
--
ALTER TABLE `sys_navigation`
  MODIFY `Id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;
--
-- 使用表AUTO_INCREMENT `sys_pages`
--
ALTER TABLE `sys_pages`
  MODIFY `Id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- 使用表AUTO_INCREMENT `sys_pages_cate`
--
ALTER TABLE `sys_pages_cate`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- 使用表AUTO_INCREMENT `sys_user`
--
ALTER TABLE `sys_user`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=19;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
