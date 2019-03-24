<?
	
require_once('site_db.php');

$userid = $_GET['userid'];
$passwd = $_GET['passwd'];
$type = $_GET['type'];

run_query("INSERT INTO users VALUE ('$userid', '$passwd', '$type')");

?>