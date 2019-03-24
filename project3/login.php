<?
session_start();
	
require_once('site_core.php');
require_once('site_db.php');

echo_head("Admin Login");
echo '<div class="container">';

if ($_SESSION['authenticated']) { //if logged in
  echo '
    <div class="alert alert-info">Already logged in</div>
    <a href="admin_logout.php" class="btn btn-primary">Logout</a>';
}
else {
  // Add the login code, i.e., if statement to check the key matches, otherwise print the form
    $userid = $_POST['userid'];
    
    if ($userid == null) { // if form was not submitted
      echo '
        <form action="login.php" method="post">
        <label>User ID: <input type="text" class="form-control" name="userid"></label>
        <label type="password">Password: <input type="password" class="form-control" name="passwd"></label>
        <input type="submit" class="btn btn-primary">	
        </form>';
        
        
    }
    else {
    
        $user_submitted_password = $_POST['passwd'];
        $sql = "SELECT passwd, type FROM ll04dohm_users WHERE userid = '$userid'";
        $hashed_password = "";
        $result = run_query($sql);
        $row = $result->fetch_row();
        $hashed_password = $row[0];

        if (password_verify($user_submitted_password, $hashed_password)) {
            $_SESSION['authenticated'] = true;
            
            if ($row[1] == 1) {
                echo '<a href="control_panel.php" class="btn btn-primary">Admin Control Panel</a>';
            }
            else {
                echo '<a href="control_panel2.php" class="btn btn-primary">Normal Control Panel</a>';
            }
            echo 'Password is valid!';
        }
        else {
            echo "Invalid";
        }
    }
}	

echo '</div>';
echo_foot();	
?>