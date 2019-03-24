<?
	
/* -----------------------------------------------------------------------------
Returns the HTML of a labeled input text element with Bootstrap class names

Input: 
  Name of element (string)
  Text label of element (string)
  Value of element (string)
  Is the element required (boolean)
  

Output: HTML text (string)	
----------------------------------------------------------------------------- */
	
function return_input_text($name, $label, $value='', $required=false) {
	if ($required) $req = 'required';
	else $req = '';
	return '
		<div class="form-group">
			<label for="'.$name.'">'.$label.'</label>
			<input type="text" class="form-control" name="'.$name.'" id="'.$name.'" value="'.$value.'" '.$req.'>
		</div>';
}
/* -----------------------------------------------------------------------------
Echos return_input_text
----------------------------------------------------------------------------- */
function echo_input_text($name, $label, $value) {
	echo return_input_text($name, $label, $value);
}

/* -----------------------------------------------------------------------------
Returns the HTML of a labeled input textarea element with Bootstrap class names

Input: 
  Name of element (string)
  Text label of element (string)
  Value of element (string)
  Is the element required (boolean)
  

Output: HTML text (string)	
----------------------------------------------------------------------------- */
	
function return_textarea($name, $label, $value='', $required=false) {
	if ($required) $req = 'required';
	else $req = '';
	return '
		<div class="form-group">
			<label for="'.$name.'">'.$label.'</label>
			<textarea class="form-control" id="'.$name.'" name="'.$name.'"rows="6"  '.$req.'>'.$value.'</textarea>
		</div>';
}
/* -----------------------------------------------------------------------------
Echos return_input_textarea
----------------------------------------------------------------------------- */
function echo_textarea($name, $label, $value) {
	echo return_textarea($name, $label, $value);
}

/* -----------------------------------------------------------------------------
Returns the HTML of a form for inserting rows into the pages table

Input:  Previously submitted values (associative array)
Output: HTML text (string)	
----------------------------------------------------------------------------- */
function return_page_form($values) {
    $sql = "SELECT pageid, title FROM ll04dohm_pages";
    $result = run_query($sql);
    // Transform it into an associative array
    $parent = array();
    while ($row = $result->fetch_assoc()) {
		$parent[ $row['pageid'] ] = $row['title'];
    }
    /*return_input_text('parent','Parent Page',$values['parent']).'*/
	return '
		<form action="?action=insert" method="post">'.
			return_input_text('pageid','Page ID',$values['pageid'],true).
			return_input_text('title','Page Title',$values['title'],true).
			return_textarea('content','Page Content',$values['content']). 	
            return_option_select('parent', $parent,'Parent Page',$values['parent']).'
			<input type="submit" class="btn btn-primary" value="Submit">
			<a href="?" class="btn btn-warning">Clear</a>
		</form>';
}

/* -----------------------------------------------------------------------------
Returns the HTML of a form for inserting users into the users table

Input:  Previously submitted values (associative array)
Output: HTML text (string)	
----------------------------------------------------------------------------- */
function return_user_form($values) {
	return '
		<form action="?action=insert" method="post">'.
			return_input_text('userid','User ID',$values['userid'],true).
			return_input_text('passwd','Password',$values['passwd'],true).
            return_input_text('type','Type',$values['type'],true).'
			<input type="submit" class="btn btn-primary" value="Submit">
			<a href="?" class="btn btn-warning">Clear</a>
		</form>';
}


function return_control_panel_form() {
	return '
	<form action="?action=insert" method="post">
		<a href="insert_user.php" class="btn btn-warning">Create User</a>
		<a href="update_user.php" class="btn btn-warning">Edit User</a>
		<a href="delete_user.php" class="btn btn-warning">Delete User</a>
        <br>
		<a href="insert_page.php" class="btn btn-warning">Create Page</a>
		<a href="basic_update.php" class="btn btn-warning">Edit Page</a>
		<a href="basic_delete.php" class="btn btn-warning">Delete Page</a>
        <br>
		<a href="insert_aside.php" class="btn btn-warning">Create Aside</a>
		<a href="update_aside.php" class="btn btn-warning">Edit Aside</a>
		<a href="delete_aside.php" class="btn btn-warning">Delete Aside</a>
        <br>
		<a href="insert_has_aside.php" class="btn btn-warning">Create Has Aside</a>
        <a href="show_has_asides.php" class="btn btn-warning">Edit Has Aside</a>
		<a href="delete_has_aside.php" class="btn btn-warning">Delete Has Aside</a>
	</form>';
}

function echo_control_panel_form() {
	echo return_control_panel_form();
}

function return_control_panel_form2() {
	return '
	<form action="?action=insert" method="post">
		<a href="insert_page.php" class="btn btn-warning">Create Page</a>
		<a href="basic_update.php" class="btn btn-warning">Edit Page</a>
        <br>
		<a href="insert_aside.php" class="btn btn-warning">Create Aside</a>
		<a href="update_aside.php" class="btn btn-warning">Edit Aside</a>
        <br>
		<a href="insert_has_aside.php" class="btn btn-warning">Create Has Aside</a>
        <a href="show_has_asides.php" class="btn btn-warning">Edit Has Aside</a>
	</form>';
}

function echo_control_panel_form2() {
	echo return_control_panel_form2();
}

/* -----------------------------------------------------------------------------
Echos return_user_form
----------------------------------------------------------------------------- */
function echo_user_form($values) {
	echo return_user_form($values);
}


/* -----------------------------------------------------------------------------
Echos return_page_form
----------------------------------------------------------------------------- */
function echo_page_form($values) {
	echo return_page_form($values);
}

/* -----------------------------------------------------------------------------
Inserts a new row into the pages table.

Input:  Posted values (associative array)
Output: None	
----------------------------------------------------------------------------- */
function insert_page($values) {
	$pageid = $values['pageid'];
	$title = $values['title'];
	$content = $values['content'];
	$parent = $values['parent'];
	$sql = "INSERT INTO ll04dohm_pages (pageid, title, content, parent) VALUES ('$pageid','$title','$content','$parent')";
	run_query($sql);
}
		
/* -----------------------------------------------------------------------------
Inserts a new row into the user table.

Input:  Posted values (associative array)
Output: None	
----------------------------------------------------------------------------- */
function insert_user($values) {
	$userid = $values['userid'];
	$passwd = $values['passwd'];
    $hashed_passwd = password_hash($passwd, PASSWORD_DEFAULT);
	$type = $values['type'];
	$sql = "INSERT INTO ll04dohm_users (userid, passwd, type) VALUES ('$userid','$hashed_passwd','$type')";
	run_query($sql);
}

/* -----------------------------------------------------------------------------
Returns the HTML of a form for inserting rows into the aside table
*Note* Change later to use drop down menu

Input:  Previously submitted values (associative array)
Output: HTML text (string)	
----------------------------------------------------------------------------- */
function return_aside_form($values) {
	return '
		<form action="?action=insert" method="post">'.
			return_input_text('asideid','Aside ID',$values['asideid'],true).
			return_input_text('title','Aside Title',$values['title'],true).
			return_textarea('content','Page Content',$values['content']). 	
			return_input_text('color','Color',$values['color']).'
			<input type="submit" class="btn btn-primary" value="Submit">
			<a href="?" class="btn btn-warning">Clear</a>
		</form>';
}
/* -----------------------------------------------------------------------------
Echos return_aside_form
----------------------------------------------------------------------------- */
function echo_aside_form($values) {
	echo return_aside_form($values);
}

/* -----------------------------------------------------------------------------
Inserts a new row into the aside table.

Input:  Posted values (associative array)
Output: None	
----------------------------------------------------------------------------- */
function insert_aside($values) {
	$asideid = $values['asideid'];
	$title = $values['title'];
	$content = $values['content'];
	$color = $values['color'];
	$sql = "INSERT INTO ll04dohm_asides (asideid, title, content, color) VALUES ('$asideid','$title','$content','$color')";
	run_query($sql);
}



/* -----------------------------------------------------------------------------
Returns the HTML of a form for inserting rows into the has_aside table
*Note* Change later to use drop down menu

Input:  Previously submitted values (associative array)
Output: HTML text (string)	
----------------------------------------------------------------------------- */
function return_has_aside_form($values) {
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
	return '
		<form action="?action=insert" method="post">'.
			return_option_select('asideid', $asides,'Aside ID',$values['asideid']).
			return_option_select('pageid', $page,'Page ID',$values['pageid']).
			return_input_text('ord','Order',$values['ord']).'
			<input type="submit" class="btn btn-primary" value="Submit">
			<a href="?" class="btn btn-warning">Clear</a>
		</form>';
}
/* -----------------------------------------------------------------------------
Echos return_has_aside_form
----------------------------------------------------------------------------- */
function echo_has_aside_form($values) {
	echo return_has_aside_form($values);
}

/* -----------------------------------------------------------------------------
Inserts a new row into the has_aside table.

Input:  Posted values (associative array)
Output: None	
----------------------------------------------------------------------------- */
function insert_has_aside($values) {
	$asideid = $values['asideid'];
	$pageid = $values['pageid'];
	$ord = $values['ord'];
	$sql = "INSERT INTO ll04dohm_has_aside (asideid, pageid, ord) VALUES ('$asideid','$pageid','$ord')";
	run_query($sql);
}



/* -----------------------------------------------------------------------------
Echo an option select menu

Input:
label - The label of the form element (string)
name - Uses as both the name and id of the element (string)
list - An assoicative array of unique ids and display titles

Output:  None, this function will echo HTML but return null	
----------------------------------------------------------------------------- */
		
function return_option_select($name, $list, $label='', $v='') {
	$ouput = '
	<div class="form-group">';
	
	if ($label != '')
	$ouput .= '
		<label for="'.$name.'">'.$label.'</label>';
		
	$ouput .= '		
		<select class="form-control" id="'.$name.'" name="'.$name.'">';

	foreach ($list as $id => $title) {
		$selected = '';
		if ($id == $v) $selected = 'selected';
		$ouput .= '
			<option value="'.$id.'" '.$selected.'>'.$title.'</option>';
	}
	$ouput .=  '
		</select>
	</div>';
	return $ouput;
}
/* -----------------------------------------------------------------------------
Echos eturn_option_select
----------------------------------------------------------------------------- */
function echo_option_select($name, $list, $label, $v) {
	echo return_option_select($name, $list, $label, $v);
}


/* ------------------------------------------------------
	
Create a page and test the echo_option_select functions
	
------------------------------------------------------ */	
	/*
require_once('site_core.php');
require_once('site_db.php');

// Create the HTML head and container
echo_head('Test 4');
echo '<div class="container">';

// Create an associateve array
$colors['#f00'] = 'red';
$colors['#0f0'] = 'green';
$colors['#00f'] = 'blue';
$colors['#ff0'] = 'yellow';
$colors['#f0f'] = 'purple';

// Dump the array
echo '<pre>';
var_dump($colors);
echo '</pre>';

// Test the function with the array
echo_option_select('color', $colors,'Pick a Color');

echo '<hr>';

// Get the pageid and title of all pages
$result = run_query("SELECT pageid, title FROM pages");

// Transform it into an associative array
$pages = array();
while ($row = $result->fetch_assoc()) {
		$pages[ $row['pageid'] ] = $row['title'];
}

// Dumpt the array
echo '<pre>';
var_dump($pages);
echo '</pre>';

// Test the function with the array
echo_option_select('pageid', $pages,'Pick a Page','usa');

echo '
</div>';
echo_foot();
*/
?>