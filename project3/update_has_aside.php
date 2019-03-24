<?

require_once('site_core.php');
require_once('site_forms.php');
require_once('site_db.php');

// Set the title of the page
$title = "Update Has Aside";

// Echo the HTML head with title
echo_head($title);

// Echo Bootstrap container 
echo '
	<div class="container">
		<h2>'.$title.'</h2>';
		

// Get the page id and action
$pid = $_GET['pid'];
$aid = $_GET['aid'];
$action = $_GET['action'];

// If action is update
if ($action=='update') {

	// Get the posted form data
	$ord = $_POST['ord'];
	
	// Form the query
	$sql = "UPDATE ll04dohm_has_aside SET ord = '$ord' WHERE asideid='$aid' AND pageid='$pid'";

	// Run the query
	run_query($sql);
	
	// Echo feedback
	echo '
		<p>'.$pid.' & '.$aid.'</a> was updated from has_aside</p>';
}

// If the id is given but action is not update
else {
	
	// Get the data for the selected page
	$result = run_query("SELECT * FROM ll04dohm_has_aside WHERE asideid='$aid' AND pageid='$pid'");
	$values = $result->fetch_assoc();
	
	
	// Ouput the edit form
	echo '
		<form action="update_has_aside.php?action=update&pid='.$pid.'&aid='.$aid.'" method="post">
			<label>Has Aside Page ID: <b>'.$pid.'</b> & Aside ID : </label><b>'.$aid.'</b><br>'.
			return_input_text('ord','Order',$values['ord'],true).'
			<input type="submit" class="btn btn-primary" value="Update">
		</form>';	
}

echo '</div>';

echo_foot();

?>