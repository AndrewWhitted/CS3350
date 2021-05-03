<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ./dashboard.php");
    exit;
}
require "dbutil.php";
$db = DbUtil::loginConnection();
$stmt = $db->stmt_init();
 
// Define variables and initialize with empty values
$username = $password ="";
$username_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    echo 'in POST';
 
    // Check if username is empty
    if(strlen(trim($_POST["username"], " \n\r\t\v\0")) == 0){
        $username_err = "Please enter username.";
    } 
    else{
        $username = trim($_POST["username"], " \n\r\t\v\0");
    }
    
    // Check if password is empty
    if(strlen(trim($_POST["password"], " \n\r\t\v\0")) == 0){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"], " \n\r\t\v\0");
    }
    
    //Validate credentials
    if(strlen($username_err) == 0 && strlen($password_err) == 0){
        // Prepare a select statement
        echo 'Let me in<br />';
        $sql = "SELECT username, password, role_id FROM Logins WHERE username = ?";
        
        if($stmt = mysqli_prepare($db, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $username, $hashed_password, $role_id);
                    if(mysqli_stmt_fetch($stmt)){
                        if(strcmp(crypt($password,$hashed_password), $hashed_password) == 0){
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["username"] = $username;
                            $_SESSION["role_id"] = $role_id;
                            // Redirect user to dashboard page
                            if($_SESSION["role_id"] != 1){
                         
                            	header("location: ./dashboard.php");
                            	}
                            else{
                            	header("location: ./animals-events.php");
                            }
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } 
                else{
                        // username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }

    
    // Close connection
    $db->close();
    
}

?>

    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>

        <?php 
        if(strlen($login_err) > 0){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (strlen($username_err) > 0) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (strlen($password_err) > 0) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="./registration.php">Sign up now</a>.</p>
        </form>
    </div>
</body>
</html>
