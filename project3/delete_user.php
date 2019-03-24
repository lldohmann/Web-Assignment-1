<?

require_once('site_core.php');
require_once('site_forms.php');
require_once('site_db.php');

session_start();

// Set the title of the page
$title = "Delete User";

echo_head($title);

echo '
	<div class="container">
		<h2>'.$title.'</h2>';
		

$userid = $_GET['id'];
$action = $_GET['action'];

if ($userid == '') {
	// Get the userid of all users
	$result = run_query("SELECT userid FROM ll04dohm_users");
	
	// Transform it into an associative array
	$userid = array();
	while ($row = $result->fetch_assoc()) {
		$userid[ $row['userid'] ] = $row['userid'];
	}
	
	// Generate a dropdown menu of all the pages
	echo '
		<form method="get" action="delete_user.php">'.
			return_option_select('id',$userid,'Select a user to delete').'
			<input type="submit">
		</form>';
}

else if ($action=='delete') {
	$sql = "DELETE FROM ll04dohm_users WHERE userid='$userid'";
	run_query($sql);
	echo '
		<p><b>'.$userid.'</b> was deleted from users table</p>';
}
else {		
	echo '
		<p>Are you sure you want to delete <b>'.$userid.'</b> from users table?</p>
		<p>
			<a href="delete_user.php?action=delete&id='.$userid.'" class="btn btn-danger">Yes</a>
		</p>';
}

echo '</div>';

echo_foot();

?>