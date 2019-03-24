<?

require_once('site_core.php');
require_once('site_forms.php');
require_once('site_db.php');

// Set the title of the page
$title = "Delete Has Aside";

echo_head($title);

echo '
	<div class="container">
		<h2>'.$title.'</h2>';
		

$idpage = $_GET['idpage'];
$idaside = $_GET['idaside'];
$action = $_GET['action'];

if ($idpage == '' or $idaside == '') {
	$sql = "SELECT pageid, title FROM ll04dohm_pages";
    $result = run_query($sql);
    // Transform it into an associative array
    $page = array();
    while ($row = $result->fetch_assoc()) {
		$page[ $row['pageid'] ] = $row['title'];
    }
    
    $sql2 = "SELECT asideid, title FROM ll04dohm_asides";
    $result2 = run_query($sql2);
    // Transform it into an associative array
    $asides = array();
    while ($row = $result2->fetch_assoc()) {
		$asides[ $row['asideid'] ] = $row['title'];
    }
	// Generate a dropdown menu of all the pages
	echo '
		<form method="get" action="delete_has_aside.php">'.
			return_option_select('idpage',$page,'Select the Page of the has aside').
			return_option_select('idaside',$asides,'Select an aside of the has aside').'
			<input type="submit">
		</form>';
}

else if ($action=='delete') {
	$sql = "DELETE FROM ll04dohm_has_aside WHERE asideid='$idaside' AND pageid='$idpage'";
	run_query($sql);

	// $sql = "DELETE FROM asides WHERE asideid='$id'";
	// $sql = "DELETE FROM has_aside WHERE asideid='$aid' AND pageid='$pid'";
	
	echo '
		<p><b>'.$idaside.'</b> was deleted from '.$idpage.'</p>';
}
else {		
	echo '
		<p>Are you sure you want to delete <b>'.$idpage.' & '.$idaside.'</b> from has asides?</p>
		<p>
			<a href="delete_has_aside.php?action=delete&idpage='.$idpage.'&idaside='.$idaside.'" class="btn btn-danger">Yes</a>
		</p>';
}

echo '</div>';

echo_foot();

?>