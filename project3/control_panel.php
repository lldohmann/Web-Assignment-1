<?

session_start();
if ($_SESSION['authenticated'] == false) {
    die();
}
require_once('site_core.php');
require_once('site_forms.php');
require_once('site_db.php');

// Set the title of the page
$title = "Control Panel";

echo_head($title);

// Create page content
echo '
	<div class="container">
		<h2>'.$title.'</h2>';

echo_control_panel_form();
echo '<a href="admin_logout.php" class="btn btn-primary">Logout</a>';

echo '</div>';

echo_foot();

?>