<?

/* -----------------------------------------------------------------------------
Returns start of HTML document from <!doctype> to <body> with Bootstrap 4.0 link
and custom style.css link. Slices title into head	

Input: Webpage title (string)
Output: HTML text (string)	
----------------------------------------------------------------------------- */
function return_head($title) {
	return '
		<!doctype html>
		<html lang="en">
		  <head>
		    <meta charset="utf-8">
		    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
		    <link rel="stylesheet" href="style.css">
		    <title>'.$title.'</title>
		  </head>
		  <body>';
}
/* -----------------------------------------------------------------------------
Echo return_head
----------------------------------------------------------------------------- */
function echo_head($title) {
	echo return_head($title);
}


/* -----------------------------------------------------------------------------
Returns end of HTML document from </body> to </html> with Bootstrap 4.0 scripts
jquery 3.2, popper 1.12 and boostrap 4.0

Input: None
Output: HTML text (string)	
----------------------------------------------------------------------------- */
function return_foot() {
	return '
		    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
		    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
		    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
		  </body>
		</html>';
}
/* -----------------------------------------------------------------------------
Echo  return_foot
----------------------------------------------------------------------------- */
function echo_foot() {
	echo return_foot();
}	
	

/* -----------------------------------------------------------------------------
Returns HTML document content from content database

Input: The current page id (string)
Output: HTML text (string)	
----------------------------------------------------------------------------- */
function return_content($pageid) {   	
	$sql = "SELECT title, content, parent FROM ll04dohm_pages WHERE pageid = '".$pageid."'";
	$content = run_query($sql)->fetch_assoc();

	$login = '<a class="btn btn-primary float-left" href="login.php">Log In</a>';
	if ($_SESSION['authenticated']) {
		$login = '<a class="btn btn-primary float-left" href="admin_logout.php">Logout</a>';
	}

	return '
		<div class="container">
		  <h1>'.$content['title'].'</h1>
			<div class="row">
				<div class="col-md">
					<main>'
						.$content['content'].'
					</main>
				</div>
			</div>
			<footer>
				<a class="btn btn-primary float-left" href="?pageid='.$content['parent'].'">Back to parent</a>'.
				$login.'
				<p class="float-right copy-right">&copy; '.date("Y").'</p>
			</footer>		  
	  </div>';	
}
/* -----------------------------------------------------------------------------
Echo  return_content
----------------------------------------------------------------------------- */
function echo_content($pageid) {
	echo return_content($pageid);
}	


/* -----------------------------------------------------------------------------
Returns HTML document aside content from content database

Input: The current page id (string)
Output: HTML text (string)	
----------------------------------------------------------------------------- */
function return_side_content($pageid) {   	
	$sql = "SELECT asideid FROM ll04dohm_has_aside WHERE pageid = '".$pageid."'";
	$results = run_query($sql);
    // Transform it into an associative array
    $asides = array();
    $content = '';
    while ($row = $results->fetch_assoc()) {
		$asides[ $row['asideid'] ] = $row['asideid'];
        $sql2 = "SELECT title, color, content FROM ll04dohm_asides WHERE asideid = '".$asides[$row['asideid']]."'";
        $aside = run_query($sql2)->fetch_assoc();
        $content .= '
            <aside style = "background-color:'.$aside['color'].'">
                <h2>'.$aside['title'].'</h2>
                <p>'.$aside['content'].'</p>
            </aside>';
    }
    return $content;
}
/* -----------------------------------------------------------------------------
Echo  return_side_content
----------------------------------------------------------------------------- */
function echo_side_content($pageid) {
	echo return_side_content($pageid);
}	
?>