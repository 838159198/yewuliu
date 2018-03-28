-- MySQL dump 10.13  Distrib 5.5.56, for Linux (x86_64)
--
-- Host: localhost    Database: spoa
-- ------------------------------------------------------
-- Server version	5.5.56-log

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
-- Table structure for table `ele_action_check`
--

DROP TABLE IF EXISTS `ele_action_check`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ele_action_check` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL COMMENT '考核项',
  `fid` smallint(6) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `score` tinyint(4) DEFAULT NULL COMMENT '分数',
  `grade` char(100) DEFAULT NULL COMMENT '等级',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ele_action_check`
--

LOCK TABLES `ele_action_check` WRITE;
/*!40000 ALTER TABLE `ele_action_check` DISABLE KEYS */;
/*!40000 ALTER TABLE `ele_action_check` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ele_action_month`
--

DROP TABLE IF EXISTS `ele_action_month`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ele_action_month` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL COMMENT '标题',
  `mid` mediumint(9) NOT NULL COMMENT '创建者',
  `createdatetime` datetime NOT NULL COMMENT '创建时间',
  `startdatetime` datetime NOT NULL COMMENT '开始日期',
  `enddatetime` datetime NOT NULL COMMENT '截止日期',
  `num` tinyint(4) NOT NULL COMMENT '考核人数',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '导入状态0-未1已',
  `datemonth` char(90) NOT NULL COMMENT '考核月',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ele_action_month`
--

LOCK TABLES `ele_action_month` WRITE;
/*!40000 ALTER TABLE `ele_action_month` DISABLE KEYS */;
/*!40000 ALTER TABLE `ele_action_month` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ele_action_score`
--

DROP TABLE IF EXISTS `ele_action_score`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ele_action_score` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL COMMENT '组员',
  `mid` int(11) DEFAULT NULL COMMENT '负责人',
  `score` float(4,1) DEFAULT NULL COMMENT '得分',
  `createdatetime` datetime DEFAULT NULL,
  `type` char(100) DEFAULT NULL COMMENT '类型',
  `createdate` char(100) DEFAULT NULL COMMENT '评分月',
  `content` varchar(255) DEFAULT NULL COMMENT '评价',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=471 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ele_action_score`
--

LOCK TABLES `ele_action_score` WRITE;
/*!40000 ALTER TABLE `ele_action_score` DISABLE KEYS */;
/*!40000 ALTER TABLE `ele_action_score` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ele_change`
--

DROP TABLE IF EXISTS `ele_change`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ele_change` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `uid` int(6) DEFAULT NULL,
  `file` varchar(50) DEFAULT NULL,
  `content` text,
  `createtime` datetime DEFAULT NULL,
  `time` int(10) DEFAULT NULL,
  `postid` int(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ele_change`
--

LOCK TABLES `ele_change` WRITE;
/*!40000 ALTER TABLE `ele_change` DISABLE KEYS */;
/*!40000 ALTER TABLE `ele_change` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ele_check_score`
--

DROP TABLE IF EXISTS `ele_check_score`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ele_check_score` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '单项得分',
  `score` float(4,1) NOT NULL COMMENT '得分',
  `uid` int(11) NOT NULL COMMENT '导入时间',
  `createdatetime` datetime NOT NULL COMMENT '创建日期',
  `type` char(100) NOT NULL COMMENT '考核项',
  `m_id` int(11) NOT NULL COMMENT '月id',
  `updatetime` datetime NOT NULL COMMENT '评分时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=729 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ele_check_score`
--

LOCK TABLES `ele_check_score` WRITE;
/*!40000 ALTER TABLE `ele_check_score` DISABLE KEYS */;
/*!40000 ALTER TABLE `ele_check_score` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ele_department`
--

DROP TABLE IF EXISTS `ele_department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ele_department` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `department` varchar(255) DEFAULT NULL COMMENT '所属部门',
  `f_id` int(11) DEFAULT NULL COMMENT '上级部门id',
  `status` int(1) DEFAULT '1' COMMENT '部门是否启用。1=>启用,0=>禁用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ele_department`
--

LOCK TABLES `ele_department` WRITE;
/*!40000 ALTER TABLE `ele_department` DISABLE KEYS */;
/*!40000 ALTER TABLE `ele_department` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ele_kpi_check`
--

DROP TABLE IF EXISTS `ele_kpi_check`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ele_kpi_check` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `beizhu` varchar(255) DEFAULT NULL,
  `sum` int(11) DEFAULT NULL,
  `score` int(11) DEFAULT NULL COMMENT '扣分',
  `createdate` int(11) DEFAULT NULL,
  `month_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1573 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ele_kpi_check`
--

LOCK TABLES `ele_kpi_check` WRITE;
/*!40000 ALTER TABLE `ele_kpi_check` DISABLE KEYS */;
/*!40000 ALTER TABLE `ele_kpi_check` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ele_kpi_log`
--

DROP TABLE IF EXISTS `ele_kpi_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ele_kpi_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `month_id` int(11) DEFAULT NULL COMMENT '考核月id',
  `mid` int(11) DEFAULT NULL COMMENT '修改者',
  `check_id` int(11) DEFAULT NULL COMMENT '考核项id',
  `score` int(11) DEFAULT NULL COMMENT '扣分',
  `uid` int(11) DEFAULT NULL COMMENT '用户id',
  `datetime` int(11) DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=449 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ele_kpi_log`
--

LOCK TABLES `ele_kpi_log` WRITE;
/*!40000 ALTER TABLE `ele_kpi_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `ele_kpi_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ele_kpi_month`
--

DROP TABLE IF EXISTS `ele_kpi_month`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ele_kpi_month` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL COMMENT '标题',
  `mid` int(10) unsigned NOT NULL COMMENT '创建人',
  `createdate` int(10) unsigned NOT NULL COMMENT '创建时间',
  `createdatetime` datetime NOT NULL,
  `num` int(10) unsigned NOT NULL COMMENT '人数',
  `status` int(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态1全部提交0未完成',
  `startdatetime` datetime NOT NULL,
  `startdate` int(10) NOT NULL,
  `enddate` int(10) unsigned NOT NULL COMMENT '截止时间',
  `enddatetime` datetime NOT NULL,
  `weeks` tinyint(4) NOT NULL DEFAULT '4' COMMENT '周数',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ele_kpi_month`
--

LOCK TABLES `ele_kpi_month` WRITE;
/*!40000 ALTER TABLE `ele_kpi_month` DISABLE KEYS */;
/*!40000 ALTER TABLE `ele_kpi_month` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ele_kpi_project`
--

DROP TABLE IF EXISTS `ele_kpi_project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ele_kpi_project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '考核项',
  `explain` varchar(255) DEFAULT NULL COMMENT '解释',
  `status` int(11) DEFAULT '1' COMMENT '状态1-正常 2-禁用',
  `attribute` int(11) DEFAULT NULL COMMENT '归属性0-共有 1-开发 2-测试',
  `rule` varchar(255) DEFAULT NULL COMMENT '扣分指标',
  `sum` int(11) DEFAULT NULL COMMENT '总分值',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ele_kpi_project`
--

LOCK TABLES `ele_kpi_project` WRITE;
/*!40000 ALTER TABLE `ele_kpi_project` DISABLE KEYS */;
/*!40000 ALTER TABLE `ele_kpi_project` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ele_manage`
--

DROP TABLE IF EXISTS `ele_manage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ele_manage` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL COMMENT '帐号',
  `password` varchar(32) NOT NULL COMMENT '密码',
  `joinip` varchar(15) NOT NULL COMMENT '注册IP',
  `overip` varchar(15) NOT NULL COMMENT '登陆IP',
  `jointime` int(10) NOT NULL COMMENT '注册时间',
  `overtime` int(10) NOT NULL COMMENT '登陆时间',
  `auth` text NOT NULL COMMENT '权限',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态',
  `role` int(11) unsigned NOT NULL COMMENT '角色',
  `name` varchar(32) NOT NULL COMMENT '姓名',
  `sex` int(1) DEFAULT '0' COMMENT '0=>男，1=>女',
  `ismarry` int(1) DEFAULT '0' COMMENT '0->未婚,1->已婚',
  `phone` int(11) DEFAULT NULL COMMENT '联系电话',
  `picture` varchar(255) DEFAULT NULL COMMENT '员工照片',
  `birthday` int(11) DEFAULT NULL COMMENT '出生日期',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注信息',
  `idcard` char(20) DEFAULT NULL COMMENT '有效证件号码',
  `promotion` int(1) DEFAULT '0' COMMENT '0=》不可晋升，1=》可晋升，2=》等待晋升，3=》已晋升',
  `mark` char(255) DEFAULT NULL COMMENT '客服追踪用户状态的id—list，最多只能同时追踪20个用户',
  `pro_time` int(11) DEFAULT NULL COMMENT '确认晋升的时间',
  `department` int(11) unsigned DEFAULT NULL COMMENT '部门id',
  `qq` varchar(255) DEFAULT NULL COMMENT '工作QQ，便于收发邮件',
  `credits` int(11) NOT NULL DEFAULT '0' COMMENT '积分',
  `complete_num` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '完成数量',
  `underway_num` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '进行中数量',
  `create_num` int(11) unsigned NOT NULL COMMENT '创建数量',
  `developmenttimes` int(11) unsigned NOT NULL COMMENT '总用时',
  `rollback_num` int(10) unsigned NOT NULL COMMENT '退回数量',
  `is_head` int(255) DEFAULT '3',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8 COMMENT='管理员';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ele_manage`
--

LOCK TABLES `ele_manage` WRITE;
/*!40000 ALTER TABLE `ele_manage` DISABLE KEYS */;
INSERT INTO `ele_manage` VALUES (1,'admin','b30bdc0cd235330edabe60a6defaa406','127.0.0.1','42.202.21.26',1366337134,1428906204,'manage.statsonlinertu.index,manage.link.index,manage.link.create,manage.link.update,manage.link.del,manage.statsdetail.index,manage.statsdetail.ycgg,manage.statsdetail.dbt,manage.statsdetail.exportiptxt,manage.statsdetail.exportiptxtdbt,manage.statsdetail.ycggdetail,manage.statsdetail.dbtdetail,manage.statsdetail.upurldetail,manage.statsdetail.ycggstats,manage.statsdetail.dbtstats,manage.statsdetail.eda,manage.statsdetail.h123,manage.statsdetail.edadetail,manage.statsdetail.h123detail,manage.statsdetail.gda,manage.statsdetail.gdadetail,manage.statsdetail.agent,manage.statsdetail.agentmember,manage.cooperation.index,manage.cooperation.detail,manage.cooperation.update,manage.admin.admin,manage.admin.view,manage.admin.create,manage.admin.update,manage.admin.delete,manage.mail.index,manage.mail.create,manage.mail.createmailtouidlist,manage.mail.delete,manage.mail.view,manage.stats.graphs,manage.stats.dropdata,manage.stats.askfortask,manage.stats.sendtask,manage.stats.dropdataexcel,manage.mytask.staffprovisitetask,manage.mytask.weekly,manage.mytask.continue,manage.mytask.addweektask,manage.mytask.updateweektaskendtime1,manage.mytask.updateweektaskendtime2,manage.default.edacdn,manage.task.checklist,manage.task.deltaskbymsg,manage.task.deltask,manage.task.checkout,manage.task.getscore,manage.task.updetasktype,manage.task.updetasktypeall,manage.task.checkalltask,manage.task.showtasklist,manage.serachinfo.view,manage.serachinfo.create,manage.serachinfo.update,manage.serachinfo.updatestatus,manage.serachinfo.delete,manage.serachinfo.index,manage.serachinfo.admin,manage.serachinfo.zxjlcreate,manage.price.index,manage.price.members,manage.price.delete,manage.price.deleteall,manage.price.update,manage.article.index,manage.article.create,manage.article.update,manage.article.del,manage.article.category,manage.article.categorycreate,manage.article.categoryupdate,manage.article.categorydel,manage.pay.statement,manage.pay.spike,manage.membercategory.index,manage.membercategory.shownext,manage.membercategory.addtree,manage.membercategory.addtoptree,manage.membercategory.showmsg,manage.membercategory.delmsg,manage.membercategory.updatecatamsg,manage.membercategory.create,manage.membercategory.update,manage.membercategory.delete,manage.managemessage.index,manage.managemessage.record,manage.managemessage.messgae,manage.managemessage.mymessage,manage.managemessage.deduct,manage.managemessage.payback,manage.managemessage.wagecount,manage.managemessage.manageleave,manage.managemessage.checkmanageleave,manage.managemessage.adddeductbyadmin,manage.managemessage.mywagelist,manage.managemessage.wagelistpower,manage.managemessage.showweektaskmsglistbydate,manage.managemessage.showweektaskearningsbydate,manage.managemessage.showwagebydate,manage.managemessage.gettasknewmsgbydate,manage.advisoryrecords.index,manage.closeaccount.import,manage.role.index,manage.role.create,manage.role.update,manage.role.delete,manage.archives.index,manage.archives.create,manage.archives.update,manage.archives.delete,manage.memberpool.backtask,manage.memberpool.droptask,manage.memberpool.payback,manage.memberpool.indexpro,manage.memberpool.indexnopro,manage.memberpool.indexspare,manage.memberpool.refusetask,manage.memberpool.tasktype,manage.memberpool.delnotallowtask,manage.memberpool.delwaittoallowtask,manage.memberpool.delvisitetask,manage.memberpool.askforvisitetask,manage.memberpool.visit,manage.memberpool.gettask,manage.memberpool.mytask,manage.memberpool.reply,manage.memberpool.usermsg,manage.memberpool.setmsg,manage.memberpool.changepool,manage.memberpool.info,manage.memberpool.changepoolall,manage.memberpool.lastcontactlist,manage.memberpool.help,manage.gainadvert.index,manage.gainadvert.new,manage.gainadvert.edit,manage.gainadvert.close,manage.gainadvert.exclude,manage.import.aaa,manage.import.config,manage.import.index,manage.import.excel,manage.import.self,manage.import.url,manage.import.text,manage.memberinfo.index,manage.memberinfo.setmembercatalogue,manage.memberinfo.delmembercatalogue,manage.memberinfo.showcataloguefid,manage.memberinfo.memberlastcontacetime,manage.memberinfo.repeal,manage.memberinfo.askfortask,manage.memberinfo.graphs,manage.memberinfo.searchlogindate,manage.memberinfo.loginmember,manage.memberinfo.update,manage.memberinfo.resetpwd,manage.memberinfo.info,manage.memberinfo.sendtask,manage.memberinfo.task,manage.memberinfo.price,manage.memberinfo.log,manage.memberinfo.category,manage.memberinfo.mark,manage.memberinfo.checkmark,manage.memberinfo.giveupthismember,manage.memberinfo.showmanagelist,manage.memberinfo.showadvrec,manage.resource.index,manage.resource.create,manage.resource.update,manage.resource.delete',1,2,'贺丰',0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,29,NULL,0,0,0,0,0,0,3),(3,'liyashan','acdb6f5513cc37be154fd220fef54d94','127.0.0.1','127.0.0.1',1366337134,1437628897,'manage.admin.admin,manage.admin.view,manage.admin.create,manage.admin.update,manage.admin.delete,manage.advert.index,manage.advert.showtime,manage.advisoryrecords.index,manage.archives.index,manage.archives.create,manage.archives.update,manage.archives.delete,manage.article.index,manage.article.create,manage.article.update,manage.article.del,manage.article.category,manage.article.categorycreate,manage.article.categoryupdate,manage.article.categorydel,manage.branchgainadvert.index,manage.branchgainadvert.new,manage.branchgainadvert.edit,manage.branchgainadvert.close,manage.branchgainadvert.exclude,manage.closeaccount.index,manage.closeaccount.batch,manage.closeaccount.release,manage.closeaccount.import,manage.closeaccount.jsdh,manage.closeaccount.ycgg,manage.closeaccount.dbt,manage.cooperation.index,manage.cooperation.detail,manage.cooperation.update,manage.default.flush,manage.default.cdn,manage.default.edacdn,manage.earning.index,manage.earning.paylog,manage.earning.member,manage.earning.count,manage.gainadvert.index,manage.gainadvert.new,manage.gainadvert.edit,manage.gainadvert.close,manage.gainadvert.exclude,manage.gainadvert.excluderight,manage.import.aaa,manage.import.config,manage.import.index,manage.import.excel,manage.import.self,manage.import.url,manage.import.text,manage.import.clear,manage.importhomeshow.index,manage.importhomeshow.save,manage.importonlinertu.index,manage.importonlinertu.save,manage.jsdhinvalid.index,manage.jsdhinvalid.create,manage.jsdhinvalid.delete,manage.link.index,manage.link.create,manage.link.update,manage.link.del,manage.mail.index,manage.mail.create,manage.mail.createmailtouidlist,manage.mail.delete,manage.mail.view,manage.managemessage.index,manage.managemessage.record,manage.managemessage.messgae,manage.managemessage.mymessage,manage.managemessage.deduct,manage.managemessage.payback,manage.managemessage.wagecount,manage.managemessage.manageleave,manage.managemessage.checkmanageleave,manage.managemessage.adddeductbyadmin,manage.managemessage.mywagelist,manage.managemessage.wagelistpower,manage.managemessage.showweektaskmsglistbydate,manage.managemessage.showweektaskearningsbydate,manage.managemessage.showwagebydate,manage.managemessage.gettasknewmsgbydate,manage.memberbranch.index,manage.memberbranch.create,manage.memberbranch.update,manage.membercategory.index,manage.membercategory.shownext,manage.membercategory.addtree,manage.membercategory.addtoptree,manage.membercategory.showmsg,manage.membercategory.delmsg,manage.membercategory.updatecatamsg,manage.membercategory.create,manage.membercategory.update,manage.membercategory.delete,manage.membercredits.index,manage.membergroup.index,manage.membergroup.update,manage.memberinfo.index,manage.memberinfo.setmembercatalogue,manage.memberinfo.delmembercatalogue,manage.memberinfo.showcataloguefid,manage.memberinfo.memberlastcontacetime,manage.memberinfo.repeal,manage.memberinfo.askfortask,manage.memberinfo.graphs,manage.memberinfo.searchlogindate,manage.memberinfo.loginmember,manage.memberinfo.create,manage.memberinfo.update,manage.memberinfo.resetpwd,manage.memberinfo.info,manage.memberinfo.sendtask,manage.memberinfo.task,manage.memberinfo.price,manage.memberinfo.log,manage.memberinfo.category,manage.memberinfo.mark,manage.memberinfo.checkmark,manage.memberinfo.giveupthismember,manage.memberinfo.showmanagelist,manage.memberinfo.showadvrec,manage.memberinfo.loginhy,manage.memberpool.backtask,manage.memberpool.droptask,manage.memberpool.payback,manage.memberpool.taskcount,manage.memberpool.indexpro,manage.memberpool.indexnopro,manage.memberpool.indexspare,manage.memberpool.refusetask,manage.memberpool.tasktype,manage.memberpool.delnotallowtask,manage.memberpool.delwaittoallowtask,manage.memberpool.delvisitetask,manage.memberpool.delvisitetaskall,manage.memberpool.askforvisitetask,manage.memberpool.askforvisitevtask,manage.memberpool.visit,manage.memberpool.gettask,manage.memberpool.mytask,manage.memberpool.reply,manage.memberpool.usermsg,manage.memberpool.setmsg,manage.memberpool.changepool,manage.memberpool.info,manage.memberpool.changepoolall,manage.memberpool.lastcontactlist,manage.memberpool.help,manage.memberpool.help2,manage.pay.index,manage.pay.member,manage.pay.memberbill,manage.pay.memberbill_his,manage.pay.excel,manage.pay.update,manage.pay.updates,manage.pay.stats,manage.pay.stats2,manage.pay.stats3,manage.pay.statement,manage.pay.spike',1,9,'李亚山',0,0,NULL,NULL,NULL,NULL,NULL,0,'23,8826',NULL,20,NULL,14424,478,4,133,70458,0,3),(14,'chenxu1302','bfe55ed3d3d55fb630d4036a50c55238','222.168.119.24','182.201.75.186',1367892052,1435021813,'manage.statsonlinertu.index,manage.link.index,manage.link.create,manage.link.update,manage.link.del,manage.advert.index,manage.advert.showtime,manage.statsdetail.index,manage.statsdetail.ycgg,manage.statsdetail.dbt,manage.statsdetail.exportiptxt,manage.statsdetail.exportiptxtdbt,manage.statsdetail.ycggdetail,manage.statsdetail.dbtdetail,manage.statsdetail.upurldetail,manage.statsdetail.ycggstats,manage.statsdetail.dbtstats,manage.statsdetail.eda,manage.statsdetail.h123,manage.statsdetail.edadetail,manage.statsdetail.h123detail,manage.statsdetail.gda,manage.statsdetail.gdadetail,manage.statsdetail.agent,manage.statsdetail.agentmember,manage.statsdetail.agentmemberdetail,manage.cooperation.index,manage.cooperation.detail,manage.cooperation.update,manage.mail.index,manage.mail.create,manage.mail.createmailtouidlist,manage.mail.delete,manage.mail.view,manage.stats.graphs,manage.stats.dropdata,manage.stats.askfortask,manage.stats.sendtask,manage.mytask.staffprovisitetask,manage.mytask.weekly,manage.mytask.showlastweektask,manage.mytask.continue,manage.mytask.addweektask,manage.mytask.updateweektaskendtime1,manage.mytask.updateweektaskendtime2,manage.task.checklist,manage.task.deltaskbymsg,manage.task.deltask,manage.task.checkout,manage.task.getscore,manage.task.updetasktype,manage.task.updetaskvtype,manage.task.updetasktypeall,manage.task.checkalltask,manage.task.showtasklist,manage.serachinfo.view,manage.serachinfo.create,manage.serachinfo.update,manage.serachinfo.updatestatus,manage.serachinfo.delete,manage.serachinfo.index,manage.serachinfo.admin,manage.serachinfo.zxjlcreate,manage.importhomeshow.index,manage.importhomeshow.save,manage.article.index,manage.article.create,manage.article.update,manage.article.del,manage.article.category,manage.article.categorycreate,manage.article.categoryupdate,manage.article.categorydel,manage.pay.index,manage.pay.member,manage.pay.memberbill,manage.pay.memberbill_his,manage.pay.excel,manage.pay.update,manage.pay.updates,manage.pay.stats,manage.pay.statement,manage.importonlinertu.index,manage.importonlinertu.save,manage.membercategory.index,manage.membercategory.shownext,manage.membercategory.addtree,manage.membercategory.addtoptree,manage.membercategory.showmsg,manage.membercategory.delmsg,manage.membercategory.updatecatamsg,manage.membercategory.create,manage.membercategory.update,manage.membercategory.delete,manage.earning.index,manage.earning.paylog,manage.earning.member,manage.earning.count,manage.managemessage.index,manage.managemessage.record,manage.managemessage.messgae,manage.managemessage.mymessage,manage.managemessage.deduct,manage.managemessage.payback,manage.managemessage.wagecount,manage.managemessage.manageleave,manage.managemessage.checkmanageleave,manage.managemessage.adddeductbyadmin,manage.managemessage.mywagelist,manage.managemessage.wagelistpower,manage.managemessage.showweektaskmsglistbydate,manage.managemessage.showweektaskearningsbydate,manage.managemessage.showwagebydate,manage.managemessage.gettasknewmsgbydate,manage.jsdhinvalid.index,manage.jsdhinvalid.create,manage.jsdhinvalid.delete,manage.advisoryrecords.index,manage.closeaccount.index,manage.closeaccount.batch,manage.closeaccount.release,manage.closeaccount.import,manage.closeaccount.jsdh,manage.closeaccount.ycgg,manage.closeaccount.dbt,manage.role.updatemanagerolebyweektaskcallback,manage.archives.index,manage.archives.create,manage.archives.update,manage.archives.delete,manage.memberpool.backtask,manage.memberpool.droptask,manage.memberpool.payback,manage.memberpool.taskcount,manage.memberpool.indexpro,manage.memberpool.indexnopro,manage.memberpool.indexspare,manage.memberpool.refusetask,manage.memberpool.tasktype,manage.memberpool.delnotallowtask,manage.memberpool.delwaittoallowtask,manage.memberpool.delvisitetask,manage.memberpool.askforvisitetask,manage.memberpool.visit,manage.memberpool.gettask,manage.memberpool.mytask,manage.memberpool.reply,manage.memberpool.usermsg,manage.memberpool.setmsg,manage.memberpool.changepool,manage.memberpool.info,manage.memberpool.changepoolall,manage.memberpool.lastcontactlist,manage.memberpool.help,manage.gainadvert.index,manage.gainadvert.new,manage.gainadvert.edit,manage.gainadvert.close,manage.gainadvert.exclude,manage.gainadvert.excluderight,manage.import.aaa,manage.import.config,manage.import.index,manage.import.excel,manage.import.self,manage.import.url,manage.import.text,manage.import.clear,manage.memberinfo.index,manage.memberinfo.setmembercatalogue,manage.memberinfo.delmembercatalogue,manage.memberinfo.showcataloguefid,manage.memberinfo.memberlastcontacetime,manage.memberinfo.repeal,manage.memberinfo.askfortask,manage.memberinfo.graphs,manage.memberinfo.searchlogindate,manage.memberinfo.loginmember,manage.memberinfo.create,manage.memberinfo.update,manage.memberinfo.resetpwd,manage.memberinfo.info,manage.memberinfo.sendtask,manage.memberinfo.task,manage.memberinfo.price,manage.memberinfo.log,manage.memberinfo.category,manage.memberinfo.mark,manage.memberinfo.checkmark,manage.memberinfo.giveupthismember,manage.memberinfo.showmanagelist,manage.memberinfo.showadvrec,manage.memberinfo.loginhy',1,2,'陈旭',0,0,NULL,NULL,NULL,NULL,NULL,0,'',NULL,29,'2264218449@qq.com',586,1,0,22,0,0,3),(17,'tingting','acdb6f5513cc37be154fd220fef54d94','59.46.140.158','182.201.75.186',1384829123,1435020878,'manage.branchgainadvert.index,manage.branchgainadvert.new,manage.branchgainadvert.edit,manage.branchgainadvert.close,manage.statsdetail.index,manage.statsdetail.ycgg,manage.statsdetail.dbt,manage.statsdetail.exportiptxt,manage.statsdetail.ycggdetail,manage.statsdetail.dbtdetail,manage.statsdetail.upurldetail,manage.statsdetail.ycggstats,manage.statsdetail.dbtstats,manage.statsdetail.eda,manage.statsdetail.h123,manage.statsdetail.edadetail,manage.statsdetail.h123detail,manage.statsdetail.gda,manage.statsdetail.gdadetail,manage.statsdetail.agent,manage.statsdetail.agentmember,manage.statsdetail.agentmemberdetail,manage.mail.index,manage.mail.create,manage.mail.createmailtouidlist,manage.mail.delete,manage.mail.view,manage.stats.graphs,manage.stats.dropdata,manage.stats.askfortask,manage.stats.sendtask,manage.mytask.weekly,manage.mytask.updateweektask,manage.mytask.showlastweektask,manage.mytask.continue,manage.mytask.addweektask,manage.serachinfo.view,manage.serachinfo.create,manage.serachinfo.update,manage.serachinfo.updatestatus,manage.serachinfo.delete,manage.serachinfo.index,manage.serachinfo.admin,manage.serachinfo.zxjlcreate,manage.pay.statement,manage.importonlinertu.index,manage.importonlinertu.save,manage.membercategory.shownext,manage.membercategory.addtree,manage.membercategory.addtoptree,manage.membercategory.showmsg,manage.membercategory.updatecatamsg,manage.membercategory.create,manage.earning.index,manage.earning.paylog,manage.earning.member,manage.earning.count,manage.managemessage.mymessage,manage.managemessage.manageleave,manage.managemessage.mywagelist,manage.managemessage.wagelistpower,manage.managemessage.showweektaskmsglistbydate,manage.managemessage.showweektaskearningsbydate,manage.managemessage.showwagebydate,manage.managemessage.gettasknewmsgbydate,manage.advisoryrecords.index,manage.closeaccount.index,manage.closeaccount.batch,manage.closeaccount.release,manage.closeaccount.import,manage.closeaccount.jsdh,manage.closeaccount.ycgg,manage.role.updatemanagerolebyweektaskcallback,manage.memberpool.droptask,manage.memberpool.indexpro,manage.memberpool.indexnopro,manage.memberpool.indexspare,manage.memberpool.refusetask,manage.memberpool.tasktype,manage.memberpool.delnotallowtask,manage.memberpool.delwaittoallowtask,manage.memberpool.delvisitetask,manage.memberpool.askforvisitetask,manage.memberpool.visit,manage.memberpool.mytask,manage.memberpool.reply,manage.memberpool.usermsg,manage.memberpool.setmsg,manage.memberpool.changepool,manage.memberpool.info,manage.memberpool.changepoolall,manage.memberpool.lastcontactlist,manage.memberpool.help,manage.gainadvert.index,manage.gainadvert.new,manage.gainadvert.edit,manage.gainadvert.close,manage.import.index,manage.import.excel,manage.import.self,manage.import.url,manage.import.text,manage.import.clear,manage.memberinfo.index,manage.memberinfo.setmembercatalogue,manage.memberinfo.delmembercatalogue,manage.memberinfo.showcataloguefid,manage.memberinfo.memberlastcontacetime,manage.memberinfo.askfortask,manage.memberinfo.graphs,manage.memberinfo.searchlogindate,manage.memberinfo.loginmember,manage.memberinfo.update,manage.memberinfo.resetpwd,manage.memberinfo.info,manage.memberinfo.sendtask,manage.memberinfo.category,manage.memberinfo.mark,manage.memberinfo.checkmark,manage.memberinfo.giveupthismember,manage.memberinfo.showmanagelist,manage.memberinfo.showadvrec',1,4,'婷婷',1,0,2222,'/storage/manage/1401867509_6134.jpg',1398614400,'一个高尚的人，一个纯粹的人','test3',3,'9299,8347,10709,10267,9012,10136,9679,10273,10754,3062,10022',1406794373,22,'1509104246@qq.com',10004,148,9,288,0,0,3),(21,'liming','acdb6f5513cc37be154fd220fef54d94','182.201.3.44','182.201.75.186',1407124648,1435021653,'manage.statsonlinertu.index',0,2,'李明',0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,16,'2962836542@qq.com',4952,148,1,114,49346,0,3),(22,'shanshan','9d4110ada9a86fec37ccd976e5085003','182.201.3.44','192.168.0.111',1407124686,1436168568,'manage.statsonlinertu.index,manage.statsdetail.index,manage.statsdetail.ycgg,manage.statsdetail.dbt,manage.statsdetail.exportiptxt,manage.statsdetail.exportiptxtdbt,manage.statsdetail.ycggdetail,manage.statsdetail.dbtdetail,manage.statsdetail.upurldetail,manage.statsdetail.ycggstats,manage.statsdetail.dbtstats,manage.statsdetail.eda,manage.statsdetail.h123,manage.statsdetail.edadetail,manage.statsdetail.gda,manage.statsdetail.gdadetail,manage.statsdetail.agent,manage.statsdetail.agentmember,manage.statsdetail.agentmemberdetail',1,1,'白珊珊',0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,19,'1929544724@qq.com',23296,369,7,224,44985,0,3),(25,'yaojiao','60f812f2e60a921cf8ab98e15d0ccd27','113.235.112.229','42.202.21.137',1418002438,1434695776,'manage.cooperation.index,manage.cooperation.detail,manage.cooperation.update,manage.mail.index,manage.mail.create,manage.mail.view,manage.membercategory.shownext,manage.membercategory.addtree,manage.membercategory.addtoptree,manage.membercategory.showmsg,manage.membercategory.delmsg,manage.membercategory.updatecatamsg,manage.membercategory.create,manage.managemessage.mymessage,manage.managemessage.manageleave,manage.managemessage.mywagelist,manage.managemessage.wagelistpower,manage.managemessage.gettasknewmsgbydate,manage.advisoryrecords.index,manage.role.updatemanagerolebyweektaskcallback,manage.memberpool.taskcount,manage.memberpool.indexpro,manage.memberpool.indexnopro,manage.memberpool.indexspare,manage.memberpool.refusetask,manage.memberpool.tasktype,manage.memberpool.delnotallowtask,manage.memberpool.delwaittoallowtask,manage.memberpool.delvisitetask,manage.memberpool.askforvisitetask,manage.memberpool.askforvisitevtask,manage.memberpool.visit,manage.memberpool.mytask,manage.memberpool.reply,manage.memberpool.usermsg,manage.memberpool.setmsg,manage.memberpool.changepool,manage.memberpool.info,manage.memberpool.changepoolall,manage.memberpool.lastcontactlist,manage.memberpool.help,manage.memberpool.help2,manage.memberinfo.index,manage.memberinfo.showcataloguefid,manage.memberinfo.askfortask,manage.memberinfo.graphs,manage.memberinfo.searchlogindate,manage.memberinfo.info,manage.memberinfo.category,manage.memberinfo.mark,manage.memberinfo.checkmark,manage.memberinfo.giveupthismember,manage.memberinfo.showmanagelist,manage.memberinfo.showadvrec',1,10,'姚娇',0,0,NULL,NULL,NULL,NULL,NULL,0,'',NULL,25,NULL,8138,77,24,297,0,0,3),(29,'zhangkaining','acdb6f5513cc37be154fd220fef54d94','182.201.75.133','127.0.0.1',1427245267,1437703638,'manage.admin.admin,manage.admin.view,manage.admin.create,manage.admin.update,manage.admin.delete,manage.advert.index,manage.advert.showtime,manage.advisoryrecords.index,manage.archives.index,manage.archives.create,manage.archives.update,manage.archives.delete,manage.article.index,manage.article.create,manage.article.update,manage.article.del,manage.article.category,manage.article.categorycreate,manage.article.categoryupdate,manage.article.categorydel,manage.branchgainadvert.index,manage.branchgainadvert.new,manage.branchgainadvert.edit,manage.branchgainadvert.close,manage.branchgainadvert.exclude,manage.closeaccount.index,manage.closeaccount.batch,manage.closeaccount.release,manage.closeaccount.import,manage.closeaccount.jsdh,manage.closeaccount.ycgg,manage.closeaccount.dbt,manage.cooperation.index,manage.cooperation.detail,manage.cooperation.update,manage.default.flush,manage.default.cdn,manage.default.edacdn,manage.earning.index,manage.earning.paylog,manage.earning.member,manage.earning.count,manage.gainadvert.index,manage.gainadvert.new,manage.gainadvert.edit,manage.gainadvert.close,manage.gainadvert.exclude,manage.gainadvert.excluderight,manage.import.aaa,manage.import.config,manage.import.index,manage.import.excel,manage.import.self,manage.import.url,manage.import.text,manage.import.clear,manage.importhomeshow.index,manage.importhomeshow.save,manage.importonlinertu.index,manage.importonlinertu.save,manage.jsdhinvalid.index,manage.jsdhinvalid.create,manage.jsdhinvalid.delete,manage.link.index,manage.link.create,manage.link.update,manage.link.del,manage.mail.index,manage.mail.create,manage.mail.createmailtouidlist,manage.mail.delete,manage.mail.view,manage.managemessage.index,manage.managemessage.record,manage.managemessage.messgae,manage.managemessage.mymessage,manage.managemessage.deduct,manage.managemessage.payback,manage.managemessage.wagecount,manage.managemessage.manageleave,manage.managemessage.checkmanageleave,manage.managemessage.adddeductbyadmin,manage.managemessage.mywagelist,manage.managemessage.wagelistpower,manage.managemessage.showweektaskmsglistbydate,manage.managemessage.showweektaskearningsbydate,manage.managemessage.showwagebydate,manage.managemessage.gettasknewmsgbydate,manage.memberbranch.index,manage.memberbranch.create,manage.memberbranch.update,manage.membercategory.index,manage.membercategory.shownext,manage.membercategory.addtree,manage.membercategory.addtoptree,manage.membercategory.showmsg,manage.membercategory.delmsg,manage.membercategory.updatecatamsg,manage.membercategory.create,manage.membercategory.update,manage.membercategory.delete,manage.membercredits.index,manage.membergroup.index,manage.membergroup.update,manage.memberinfo.index,manage.memberinfo.setmembercatalogue,manage.memberinfo.delmembercatalogue,manage.memberinfo.showcataloguefid,manage.memberinfo.memberlastcontacetime,manage.memberinfo.repeal,manage.memberinfo.askfortask,manage.memberinfo.graphs,manage.memberinfo.searchlogindate,manage.memberinfo.loginmember,manage.memberinfo.create,manage.memberinfo.update,manage.memberinfo.resetpwd,manage.memberinfo.info,manage.memberinfo.sendtask,manage.memberinfo.task,manage.memberinfo.price,manage.memberinfo.log,manage.memberinfo.category,manage.memberinfo.mark,manage.memberinfo.checkmark,manage.memberinfo.giveupthismember,manage.memberinfo.showmanagelist,manage.memberinfo.showadvrec,manage.memberinfo.loginhy,manage.memberpool.backtask,manage.memberpool.droptask,manage.memberpool.payback,manage.memberpool.taskcount,manage.memberpool.indexpro,manage.memberpool.indexnopro,manage.memberpool.indexspare,manage.memberpool.refusetask,manage.memberpool.tasktype,manage.memberpool.delnotallowtask,manage.memberpool.delwaittoallowtask,manage.memberpool.delvisitetask,manage.memberpool.delvisitetaskall,manage.memberpool.askforvisitetask,manage.memberpool.askforvisitevtask,manage.memberpool.visit,manage.memberpool.gettask,manage.memberpool.mytask,manage.memberpool.reply,manage.memberpool.usermsg,manage.memberpool.setmsg,manage.memberpool.changepool,manage.memberpool.info,manage.memberpool.changepoolall,manage.memberpool.lastcontactlist,manage.memberpool.help,manage.memberpool.help2,manage.pay.index,manage.pay.member,manage.pay.memberbill,manage.pay.memberbill_his,manage.pay.excel,manage.pay.update,manage.pay.updates,manage.pay.stats,manage.pay.stats2,manage.pay.stats3,manage.pay.statement,manage.pay.spike',1,9,'张凯宁',0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,31,NULL,5390,73,9,89,0,0,3),(33,'hehehe','acdb6f5513cc37be154fd220fef54d94','127.0.0.1','',1439358586,0,'',0,7,'共同语言',0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,18,NULL,0,0,0,0,0,0,3),(34,'jilanfeng','acdb6f5513cc37be154fd220fef54d94','192.168.0.199','',1439890025,0,'',0,9,'纪澜峰',0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,18,NULL,1898,66,1,43,45058,0,3),(35,'wangxinhui','b663c51a00cfa31d2dc3e20c6573a849','192.168.0.199','',1439890048,0,'',1,7,'王馨慧',0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,23,NULL,1368,10,0,65,719,0,3),(36,'guoyaping','acdb6f5513cc37be154fd220fef54d94','192.168.0.199','',1439890398,0,'',1,7,'郭雅萍',0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,23,NULL,4734,28,2,223,60,0,3),(37,'zhangyang','acdb6f5513cc37be154fd220fef54d94','192.168.0.201','',1446172947,0,'',1,7,'张扬',0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,23,NULL,466,1,0,18,0,0,3),(38,'xiawei','acdb6f5513cc37be154fd220fef54d94','192.168.0.201','',1446172972,0,'',0,7,'夏薇',0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,23,NULL,8,0,0,0,0,0,3),(39,'zhaoxinyi','acdb6f5513cc37be154fd220fef54d94','192.168.0.201','',1446177004,0,'',1,9,'赵新一',0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,18,NULL,6146,188,0,144,17490,0,3),(40,'liuchunming','acdb6f5513cc37be154fd220fef54d94','192.168.0.201','',1457918113,0,'',1,9,'柳春明',0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,18,NULL,4408,112,13,139,0,2,3),(41,'yanghaining','acdb6f5513cc37be154fd220fef54d94','192.168.0.201','',1457918132,0,'',1,9,'杨海宁',0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,18,NULL,3088,86,12,105,0,0,3),(42,'liufengbin','fbacbfd96842e16ae351d76088c334df','192.168.0.199','',1439890398,0,'',0,7,'刘凤彬',0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,23,NULL,62,1,0,1,0,0,3),(43,'peijiannan','acdb6f5513cc37be154fd220fef54d94','192.168.0.201','',1461749378,0,'',1,11,'裴建男',0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,26,NULL,62,0,0,2,0,0,3),(44,'zhuhaolin','acdb6f5513cc37be154fd220fef54d94','192.168.0.201','',1462326626,0,'',0,1,'朱浩林',0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,19,NULL,1004,9,0,4,0,0,3),(45,'litingting','acdb6f5513cc37be154fd220fef54d94','192.168.0.201','',1464580919,0,'',1,11,'李婷婷',0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,26,NULL,220,1,0,3,0,0,3),(46,'dongjuan','1ce3c6cb7eb8a561066ec09c6262e52b','192.168.0.201','',1464580937,0,'',1,11,'董娟',0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,26,NULL,1678,22,0,49,0,0,3),(47,'zhangjingjing','acdb6f5513cc37be154fd220fef54d94','192.168.0.201','',1465292824,0,'',0,11,'张晶晶',0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,26,NULL,0,0,0,0,0,0,3),(48,'shenyingying','85f6bc2eb6210890254411c588c6f234','192.168.0.201','',1466042844,0,'',1,7,'沈莹莹',0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,23,NULL,1444,23,0,45,0,0,3),(49,'yujiashu','acdb6f5513cc37be154fd220fef54d94','192.168.0.201','',1467683200,0,'',1,8,'于佳束',0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,23,NULL,0,0,0,0,0,0,3),(50,'hanzhuanhui','acdb6f5513cc37be154fd220fef54d94','192.168.0.201','',1471421117,0,'',1,9,'韩转辉',0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,20,NULL,1210,30,0,28,0,0,3),(51,'shenxiu','d035994b2663657d0d4ce6ab0f5fbebc','192.168.0.201','',1472518971,0,'',1,1,'沈岫',0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,19,NULL,2510,36,0,36,0,0,3),(52,'pengzhili','acdb6f5513cc37be154fd220fef54d94','192.168.0.201','',1478135401,0,'',1,9,'彭志立',0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,20,NULL,502,10,0,9,0,0,3),(53,'lijiani','acdb6f5513cc37be154fd220fef54d94','192.168.0.201','',1478748142,0,'',0,13,'李佳妮',0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,32,NULL,20,0,0,0,0,0,3),(54,'wangying','acdb6f5513cc37be154fd220fef54d94','192.168.0.201','',1481076621,0,'',0,9,'王莹',0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,19,NULL,30,0,0,0,0,0,3),(55,'lukuan','acdb6f5513cc37be154fd220fef54d94','192.168.0.201','',1483066765,0,'',1,9,'陆宽',0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,18,NULL,50,0,1,3,0,0,3),(56,'congriyong','acdb6f5513cc37be154fd220fef54d94','192.168.0.201','',1488157985,0,'',1,9,'丛日勇',0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,18,NULL,54,2,0,3,0,0,3),(57,'liuxin','acdb6f5513cc37be154fd220fef54d94','192.168.0.201','',1488172476,0,'',1,13,'刘鑫',0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,32,NULL,0,0,0,0,0,0,3),(58,'zhaomingyu','acdb6f5513cc37be154fd220fef54d94','192.168.0.201','',1488244631,0,'',1,9,'赵明玉',0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,19,NULL,10,0,0,0,0,0,3);
/*!40000 ALTER TABLE `ele_manage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ele_manage_login_log`
--

DROP TABLE IF EXISTS `ele_manage_login_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ele_manage_login_log` (
  `uid` int(11) DEFAULT NULL COMMENT '登录管理员id',
  `overtime` int(11) DEFAULT NULL COMMENT '登录时间',
  `overip` varchar(255) DEFAULT NULL COMMENT '登录Ip地址'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ele_manage_login_log`
--

LOCK TABLES `ele_manage_login_log` WRITE;
/*!40000 ALTER TABLE `ele_manage_login_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `ele_manage_login_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ele_manage_text`
--

DROP TABLE IF EXISTS `ele_manage_text`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ele_manage_text` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `text` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ele_manage_text`
--

LOCK TABLES `ele_manage_text` WRITE;
/*!40000 ALTER TABLE `ele_manage_text` DISABLE KEYS */;
/*!40000 ALTER TABLE `ele_manage_text` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ele_operation_department`
--

DROP TABLE IF EXISTS `ele_operation_department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ele_operation_department` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `status` int(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ele_operation_department`
--

LOCK TABLES `ele_operation_department` WRITE;
/*!40000 ALTER TABLE `ele_operation_department` DISABLE KEYS */;
/*!40000 ALTER TABLE `ele_operation_department` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ele_operation_file`
--

DROP TABLE IF EXISTS `ele_operation_file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ele_operation_file` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `size` varchar(60) NOT NULL COMMENT '大小',
  `mid` int(10) unsigned NOT NULL COMMENT '上传者id',
  `createtime` int(10) unsigned NOT NULL COMMENT '上传日期，时间戳',
  `filepath` varchar(255) NOT NULL COMMENT '文件地址',
  `type` varchar(10) NOT NULL COMMENT '格式',
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3209 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ele_operation_file`
--

LOCK TABLES `ele_operation_file` WRITE;
/*!40000 ALTER TABLE `ele_operation_file` DISABLE KEYS */;
/*!40000 ALTER TABLE `ele_operation_file` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ele_operation_numlog`
--

DROP TABLE IF EXISTS `ele_operation_numlog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ele_operation_numlog` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `complete` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '完成',
  `underway` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '进行中',
  `create` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建数量',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ele_operation_numlog`
--

LOCK TABLES `ele_operation_numlog` WRITE;
/*!40000 ALTER TABLE `ele_operation_numlog` DISABLE KEYS */;
/*!40000 ALTER TABLE `ele_operation_numlog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ele_operation_onoff`
--

DROP TABLE IF EXISTS `ele_operation_onoff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ele_operation_onoff` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `postid` int(10) unsigned NOT NULL COMMENT '主题id',
  `post_uid` int(10) unsigned NOT NULL COMMENT '接收人id',
  `status` int(10) unsigned NOT NULL COMMENT '开关0关1开',
  `developtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '开发周期（分钟）',
  `start_datetime` int(10) unsigned NOT NULL COMMENT '开始时间',
  `end_datetime` int(10) unsigned NOT NULL COMMENT '结束时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14004 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ele_operation_onoff`
--

LOCK TABLES `ele_operation_onoff` WRITE;
/*!40000 ALTER TABLE `ele_operation_onoff` DISABLE KEYS */;
/*!40000 ALTER TABLE `ele_operation_onoff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ele_operation_post`
--

DROP TABLE IF EXISTS `ele_operation_post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ele_operation_post` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL COMMENT '标题',
  `content` text NOT NULL COMMENT '内容',
  `priority` int(1) unsigned NOT NULL DEFAULT '1' COMMENT '优先级1正常2紧急',
  `sc_id` int(2) unsigned NOT NULL COMMENT '网站分类sitecategory',
  `create_mid` int(10) unsigned NOT NULL COMMENT '创建人id',
  `receive_mid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '接收人id（默认0或空）',
  `file` varchar(255) NOT NULL COMMENT '附件id，多个附件id用,隔开',
  `create_datetime` datetime NOT NULL COMMENT '发布日期',
  `end_datetime` datetime NOT NULL COMMENT '结束日期',
  `receive_datetime` datetime NOT NULL COMMENT '接收日期',
  `status` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '状态1等待2进行3完成',
  `cur_status` int(2) unsigned NOT NULL DEFAULT '0' COMMENT '当前状态0关1开',
  `test_estimate` int(10) NOT NULL DEFAULT '0',
  `estimate` int(10) unsigned NOT NULL COMMENT '预估时间，单位分钟',
  `close_mid` int(10) unsigned NOT NULL COMMENT '结束任务流用户id',
  `createdatetime` int(10) NOT NULL COMMENT '创建时间戳',
  `enddatetime` int(10) unsigned NOT NULL COMMENT '结束日期时间戳',
  `receivedatetime` int(10) unsigned NOT NULL COMMENT '接收时间戳',
  `owner_mid` int(10) unsigned NOT NULL COMMENT '当前拥有者',
  `modifytime` int(10) unsigned NOT NULL COMMENT '修改时间',
  `departmentId` int(2) unsigned NOT NULL COMMENT '部门',
  `rollback_num` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '退回次数',
  `version_number` varchar(30) NOT NULL COMMENT '版本号',
  `test` int(1) unsigned NOT NULL DEFAULT '0' COMMENT '测试用例1有0无',
  `about_uid` varchar(100) DEFAULT NULL COMMENT '相关者',
  `bug` varchar(20) NOT NULL COMMENT '1严重2普通',
  `test_id` int(10) NOT NULL,
  `owner_uid` int(11) DEFAULT NULL COMMENT '开发者',
  `finishdatetime` datetime DEFAULT NULL COMMENT '期望完成时间',
  `score` tinyint(4) DEFAULT NULL COMMENT '测试评分',
  `test_content` varchar(255) NOT NULL COMMENT '评分详情',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3580 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ele_operation_post`
--

LOCK TABLES `ele_operation_post` WRITE;
/*!40000 ALTER TABLE `ele_operation_post` DISABLE KEYS */;
/*!40000 ALTER TABLE `ele_operation_post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ele_operation_rollback`
--

DROP TABLE IF EXISTS `ele_operation_rollback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ele_operation_rollback` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `postid` int(10) unsigned NOT NULL,
  `mid` int(11) NOT NULL,
  `content` text NOT NULL,
  `create_datetime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ele_operation_rollback`
--

LOCK TABLES `ele_operation_rollback` WRITE;
/*!40000 ALTER TABLE `ele_operation_rollback` DISABLE KEYS */;
/*!40000 ALTER TABLE `ele_operation_rollback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ele_operation_sitecategory`
--

DROP TABLE IF EXISTS `ele_operation_sitecategory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ele_operation_sitecategory` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `aliasname` varchar(60) NOT NULL COMMENT '别名',
  `status` int(1) unsigned NOT NULL DEFAULT '1' COMMENT '1正常0关闭',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ele_operation_sitecategory`
--

LOCK TABLES `ele_operation_sitecategory` WRITE;
/*!40000 ALTER TABLE `ele_operation_sitecategory` DISABLE KEYS */;
/*!40000 ALTER TABLE `ele_operation_sitecategory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ele_operation_test`
--

DROP TABLE IF EXISTS `ele_operation_test`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ele_operation_test` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `developer` varchar(255) NOT NULL COMMENT '开发者',
  `postid` int(10) unsigned NOT NULL COMMENT '业务流id',
  `module` varchar(255) NOT NULL COMMENT '测试模块',
  `mid` int(10) unsigned NOT NULL COMMENT '创建者id',
  `createtime` int(10) unsigned NOT NULL,
  `projectnum` int(11) unsigned NOT NULL COMMENT '项目数量',
  `status` int(1) unsigned NOT NULL DEFAULT '0' COMMENT '1全部通过0未通过',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ele_operation_test`
--

LOCK TABLES `ele_operation_test` WRITE;
/*!40000 ALTER TABLE `ele_operation_test` DISABLE KEYS */;
/*!40000 ALTER TABLE `ele_operation_test` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ele_operation_test_author`
--

DROP TABLE IF EXISTS `ele_operation_test_author`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ele_operation_test_author` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL COMMENT '姓名',
  `status` int(1) unsigned NOT NULL DEFAULT '1' COMMENT '1正常0关闭',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ele_operation_test_author`
--

LOCK TABLES `ele_operation_test_author` WRITE;
/*!40000 ALTER TABLE `ele_operation_test_author` DISABLE KEYS */;
/*!40000 ALTER TABLE `ele_operation_test_author` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ele_operation_test_project`
--

DROP TABLE IF EXISTS `ele_operation_test_project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ele_operation_test_project` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `mid` int(11) unsigned NOT NULL,
  `testid` int(10) unsigned NOT NULL,
  `status` int(1) unsigned NOT NULL DEFAULT '0' COMMENT '0不通过1通过',
  `remarks` text NOT NULL COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=312 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ele_operation_test_project`
--

LOCK TABLES `ele_operation_test_project` WRITE;
/*!40000 ALTER TABLE `ele_operation_test_project` DISABLE KEYS */;
/*!40000 ALTER TABLE `ele_operation_test_project` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ele_operation_test_template`
--

DROP TABLE IF EXISTS `ele_operation_test_template`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ele_operation_test_template` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '名称',
  `test_module` varchar(255) NOT NULL COMMENT '模块名称',
  `test_developer` varchar(255) NOT NULL,
  `test_project` text NOT NULL,
  `mid` int(10) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `updatetime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ele_operation_test_template`
--

LOCK TABLES `ele_operation_test_template` WRITE;
/*!40000 ALTER TABLE `ele_operation_test_template` DISABLE KEYS */;
/*!40000 ALTER TABLE `ele_operation_test_template` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ele_operation_thread`
--

DROP TABLE IF EXISTS `ele_operation_thread`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ele_operation_thread` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL COMMENT '回复内容',
  `datetime` int(10) unsigned NOT NULL COMMENT '回复时间',
  `file` varchar(255) NOT NULL COMMENT '文件',
  `developtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '开发周期（分钟）',
  `post_uid` int(10) unsigned NOT NULL COMMENT '接收人id',
  `start_datetime` int(10) unsigned NOT NULL COMMENT '开始时间',
  `end_datetime` int(10) unsigned NOT NULL COMMENT '结束时间',
  `postid` int(10) unsigned NOT NULL COMMENT '主题id',
  `credits` int(11) NOT NULL COMMENT '积分',
  `create_uid` int(10) unsigned NOT NULL COMMENT '发帖人id',
  `about_uid` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_name` (`postid`)
) ENGINE=InnoDB AUTO_INCREMENT=27226 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ele_operation_thread`
--

LOCK TABLES `ele_operation_thread` WRITE;
/*!40000 ALTER TABLE `ele_operation_thread` DISABLE KEYS */;
/*!40000 ALTER TABLE `ele_operation_thread` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ele_operation_timeslog`
--

DROP TABLE IF EXISTS `ele_operation_timeslog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ele_operation_timeslog` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `postid` int(10) unsigned NOT NULL COMMENT '业务id',
  `mid` int(10) unsigned NOT NULL COMMENT '人员id',
  `times` int(11) NOT NULL COMMENT '时间，分钟',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11185 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ele_operation_timeslog`
--

LOCK TABLES `ele_operation_timeslog` WRITE;
/*!40000 ALTER TABLE `ele_operation_timeslog` DISABLE KEYS */;
/*!40000 ALTER TABLE `ele_operation_timeslog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ele_operation_titlecategory`
--

DROP TABLE IF EXISTS `ele_operation_titlecategory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ele_operation_titlecategory` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `status` int(1) unsigned NOT NULL DEFAULT '1' COMMENT '1正常0关闭',
  `category` varchar(255) NOT NULL COMMENT '类名',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ele_operation_titlecategory`
--

LOCK TABLES `ele_operation_titlecategory` WRITE;
/*!40000 ALTER TABLE `ele_operation_titlecategory` DISABLE KEYS */;
/*!40000 ALTER TABLE `ele_operation_titlecategory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ele_operation_version`
--

DROP TABLE IF EXISTS `ele_operation_version`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ele_operation_version` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `one` int(5) unsigned NOT NULL,
  `two` int(5) unsigned NOT NULL,
  `three` int(5) unsigned NOT NULL,
  `four` int(5) unsigned NOT NULL,
  `vvalue` varchar(30) NOT NULL,
  `postid` int(10) unsigned NOT NULL,
  `mid` int(10) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=311 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ele_operation_version`
--

LOCK TABLES `ele_operation_version` WRITE;
/*!40000 ALTER TABLE `ele_operation_version` DISABLE KEYS */;
/*!40000 ALTER TABLE `ele_operation_version` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ele_operation_version_business`
--

DROP TABLE IF EXISTS `ele_operation_version_business`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ele_operation_version_business` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `status` int(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态1显示0隐藏',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ele_operation_version_business`
--

LOCK TABLES `ele_operation_version_business` WRITE;
/*!40000 ALTER TABLE `ele_operation_version_business` DISABLE KEYS */;
/*!40000 ALTER TABLE `ele_operation_version_business` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ele_role`
--

DROP TABLE IF EXISTS `ele_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ele_role` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `name` char(20) NOT NULL COMMENT '角色名称',
  `fid` int(11) unsigned NOT NULL COMMENT '上级ID',
  `base_wage` decimal(10,0) NOT NULL COMMENT '该等级下的基本工资',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='角色表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ele_role`
--

LOCK TABLES `ele_role` WRITE;
/*!40000 ALTER TABLE `ele_role` DISABLE KEYS */;
/*!40000 ALTER TABLE `ele_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ele_softput_record`
--

DROP TABLE IF EXISTS `ele_softput_record`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ele_softput_record` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(60) DEFAULT NULL COMMENT '客户名',
  `service_name` varchar(60) DEFAULT NULL COMMENT '业务名称',
  `version` varchar(30) DEFAULT NULL COMMENT '版本号',
  `content` text COMMENT '更新内容',
  `update_datetime` date DEFAULT NULL COMMENT '更新时间',
  `md5` varchar(32) DEFAULT NULL,
  `source_md5` varchar(32) DEFAULT NULL COMMENT '源码md5值',
  `comment` text COMMENT '备注',
  `create_datetime` varchar(10) DEFAULT NULL COMMENT '创建时间',
  `last_datetime` varchar(10) DEFAULT NULL COMMENT '最后修改时间',
  `uid` int(6) DEFAULT NULL COMMENT '创建人id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=614 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ele_softput_record`
--

LOCK TABLES `ele_softput_record` WRITE;
/*!40000 ALTER TABLE `ele_softput_record` DISABLE KEYS */;
/*!40000 ALTER TABLE `ele_softput_record` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ele_spare_timeonoff`
--

DROP TABLE IF EXISTS `ele_spare_timeonoff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ele_spare_timeonoff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `postid` int(11) NOT NULL COMMENT '业务流id',
  `post_uid` int(11) NOT NULL COMMENT '用户id',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '开关0关1开',
  `start_datetime` int(11) NOT NULL COMMENT '开始时间',
  `end_datetime` int(11) NOT NULL COMMENT '结束时间',
  `developtime` int(10) NOT NULL,
  `content` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=293 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ele_spare_timeonoff`
--

LOCK TABLES `ele_spare_timeonoff` WRITE;
/*!40000 ALTER TABLE `ele_spare_timeonoff` DISABLE KEYS */;
/*!40000 ALTER TABLE `ele_spare_timeonoff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ele_summary`
--

DROP TABLE IF EXISTS `ele_summary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ele_summary` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mid` int(10) unsigned NOT NULL COMMENT '创建人',
  `projectnum` int(10) unsigned NOT NULL COMMENT '项目数量',
  `createdatetime` datetime NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `status` int(1) unsigned NOT NULL DEFAULT '0' COMMENT '0等待添加1完成',
  `weekid` int(10) unsigned NOT NULL,
  `developtimes` int(11) NOT NULL,
  `stattime` int(10) NOT NULL,
  `endtime` int(10) NOT NULL,
  `statdatetime` datetime NOT NULL,
  `enddatetime` datetime NOT NULL,
  `importstatus` int(1) unsigned NOT NULL COMMENT '导入状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1010 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ele_summary`
--

LOCK TABLES `ele_summary` WRITE;
/*!40000 ALTER TABLE `ele_summary` DISABLE KEYS */;
/*!40000 ALTER TABLE `ele_summary` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ele_summary_project`
--

DROP TABLE IF EXISTS `ele_summary_project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ele_summary_project` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `developmenttime` int(10) unsigned NOT NULL COMMENT '开发时间',
  `estimate` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '预估时间，单位分钟',
  `username` varchar(60) NOT NULL COMMENT '开发人员',
  `status` int(1) unsigned NOT NULL COMMENT '状态',
  `remarks` text NOT NULL COMMENT '说明备注',
  `postid` int(10) unsigned NOT NULL COMMENT '业务流id',
  `createtime` int(10) NOT NULL,
  `createdatetime` datetime NOT NULL,
  `sid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5112 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ele_summary_project`
--

LOCK TABLES `ele_summary_project` WRITE;
/*!40000 ALTER TABLE `ele_summary_project` DISABLE KEYS */;
/*!40000 ALTER TABLE `ele_summary_project` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ele_summary_week`
--

DROP TABLE IF EXISTS `ele_summary_week`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ele_summary_week` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `mid` int(10) unsigned NOT NULL COMMENT '创建人',
  `createtime` int(10) unsigned NOT NULL COMMENT '创建时间',
  `createdatetime` datetime NOT NULL,
  `num` int(10) unsigned NOT NULL COMMENT '需要填写周报的人数',
  `status` int(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态1全部提交0未完成',
  `statdatetime` datetime NOT NULL,
  `stattime` int(10) NOT NULL,
  `endtime` int(10) unsigned NOT NULL COMMENT '截止时间',
  `enddatetime` datetime NOT NULL,
  `days` tinyint(4) NOT NULL DEFAULT '5' COMMENT '工作日数',
  `submit_date` datetime NOT NULL COMMENT '提交日期',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ele_summary_week`
--

LOCK TABLES `ele_summary_week` WRITE;
/*!40000 ALTER TABLE `ele_summary_week` DISABLE KEYS */;
/*!40000 ALTER TABLE `ele_summary_week` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-03-28 21:27:57
