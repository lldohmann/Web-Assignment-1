<?

require_once('site_core.php');
require_once('site_forms.php');
require_once('site_db.php');

// Set the title of the page
$title = "Update User";

// Echo the HTML head with title
echo_head($title);

// Echo Bootstrap container 
echo '
	<div class="container">
		<h2>'.$title.'</h2>';
		

// Get the page id and action
$id = $_GET['id'];
$action = $_GET['action'];

// If the id is null/blank
if ($id == '') {
	
	// Get the pageid and title of all pages
	$result = run_query("SELECT userid FROM ll04dohm_users");
	
	// Transform it into an associative array
	$users = array();
	while ($row = $result->fetch_assoc()) {
		$users[ $row['userid'] ] = $row['userid'];
	}
	
	// Generate a dropdown menu of all the pages
	echo '
		<form method="get" action="update_user.php">'.
			return_option_select('id',$users,'Select a user').'
			<input type="submit">
		</form>';
}
// If action is update
else if ($action=='update') {

	// Get the posted form data
	$userid = $_POST['userid'];
	$passwd = password_hash($_POST['passwd'], PASSWORD_DEFAULT);
	$type = $_POST['type'];
	
	// Form the query
	$sql = "UPDATE ll04dohm_users SET userid = '$userid', passwd = '$passwd', type = '$type' WHERE userid='$id'";

	// Run the query
	run_query($sql);
	
	// Echo feedback
	echo '
		<p>'.$id.' was updated from users</p>';
}

// If the id is given but action is not update
else {
	
	// Get all the pages to generate the parent drop down
	$result = run_query("SELECT userid FROM ll04dohm_users");
	$users = array();
	while ($row = $result->fetch_assoc()) {
		$users[ $row['userid'] ] = $row['userid'];
	}	
	
	// Get the data for the selected page
	$result = run_query("SELECT * FROM ll04dohm_users WHERE userid='$id'");
	$values = $result->fetch_assoc();
	
	
	// Ouput the edit form
	echo '
		<form action="update_user.php?action=update&id='.$id.'" method="post">
			<label>User ID: </label> <b>'.$id.'</b><br>'.
			return_input_text('userid','User ID',$values['userid'],true).
			return_input_text('passwd','Password',$values['passwd']). 	
			return_input_text('type','Type',$values['type']).'
			<input type="submit" class="btn btn-primary" value="Update">
		</form>';	
}

echo '</div>';

echo_foot();

?>