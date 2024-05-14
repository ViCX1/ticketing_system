<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
// Include config file
require_once "config.php";

session_start();
    $role = $_SESSION['role'];
    if(!isset($_SESSION['username']) || $role!="admin"){
      header('Location: index.php?err=2');
    }
 
// Define variables and initialize with empty values
$username = $nume = $email = $password = $confirm_password = $role ="";
$username_err = $nume_err = $email_err = $password_err = $confirm_password_err = $role_err ="";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(htmlspecialchars("$_POST[username]"))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users2 WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = htmlspecialchars("$_POST[username]");
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = htmlspecialchars("$_POST[username]");
                }
            } else{
                echo "username/ Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
     // Validate name
     if(empty(htmlspecialchars("$_POST[nume]"))){
        $nume_err = "Please enter a name.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users2 WHERE nume = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_nume);
            
            // Set parameters
            $param_nume = htmlspecialchars("$_POST[nume]");
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $nume_err = "This username is already taken.";
                } else{
                    $nume = htmlspecialchars("$_POST[nume]");
                }
            } else{
                echo "nume/ Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

     // Validate email
     if(empty(htmlspecialchars("$_POST[email]"))){
        $email_err = "Please enter a valid email address.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users2 WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = htmlspecialchars("$_POST[email]");
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "This email address is already taken.";
                } else{
                    $email = htmlspecialchars("$_POST[email]");
                }
            } else{
                echo "email/ Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate password
    if(empty(htmlspecialchars("$_POST[password]"))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(htmlspecialchars("$_POST[password]")) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = htmlspecialchars("$_POST[password]");
    }
    
    // Validate confirm password
    if(empty(htmlspecialchars("$_POST[confirm_password]"))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = htmlspecialchars("$_POST[confirm_password]");
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

    // Validate role
    if(empty(htmlspecialchars("$_POST[role]"))){
        $role_err = "Please enter the role.";     
    } else{
        $role = htmlspecialchars("$_POST[role]");
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($nume_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err) && empty($role_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users2 (username, nume, email, password, role) VALUES (?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_username, $param_nume, $param_email, $param_password, $param_role); //s= number of params
            
            // Set parameters
            $param_username = $username;
            $param_nume = $nume;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_role = $role;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                echo "User created successfully";
                header("location: admin.php");
            } else{
                echo "full/ Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Creare user nou</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($nume_err)) ? 'has-error' : ''; ?>">
                <label>Name</label>
                <input type="text" name="nume" class="form-control" value="<?php echo $nume; ?>">
                <span class="help-block"><?php echo $nume_err; ?></span>
            </div> 
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div> 
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($role_err)) ? 'has-error' : ''; ?>">
                <label>Role</label>
                <input type="role" name="role" class="form-control" value="<?php echo $role; ?>">
                <span class="help-block"><?php echo $role_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            
        </form>
    </div>    
</body>
</html>