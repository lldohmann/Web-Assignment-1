<?
	
require_once('site_db.php');

$sql = "CREATE TABLE IF NOT EXISTS `ll04dohm_pages` (
  `pageid` varchar(32) NOT NULL,
  `title` varchar(64) NOT NULL,
  `parent` varchar(32) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`pageid`)
)";

run_query($sql);

echo 'SUCCESS: The following query executed: <pre>'.$sql.'</pre>';
	
$sql2 = "CREATE TABLE IF NOT EXISTS `ll04dohm_asides` (
  `asideid` varchar(32) NOT NULL,
  `title` varchar(64) NOT NULL,
  `color` varchar(32) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`asideid`)
)";

run_query($sql2);

echo 'SUCCESS: The following query executed: <pre>'.$sql2.'</pre>';

$sql3 = "CREATE TABLE IF NOT EXISTS `ll04dohm_has_aside` (
  `pageid` varchar(32) NOT NULL,
  `asideid` varchar(32) NOT NULL,
  `ord` int(11) DEFAULT NULL,
  PRIMARY KEY (`pageid`,`asideid`)
)";

run_query($sql3);

echo 'SUCCESS: The following query executed: <pre>'.$sql3.'</pre>';
?>