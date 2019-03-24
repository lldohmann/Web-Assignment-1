<?
	
require_once('site_db.php');

$userid = $_GET['userid'];
$passwd = $_GET['passwd'];
$type = $_GET['type'];

run_query("INSERT INTO ll04dohm_users VALUE ('$userid', '$passwd', '$type')");

?>